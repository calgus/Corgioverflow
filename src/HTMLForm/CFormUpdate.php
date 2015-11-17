<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormUpdate extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor
     *
     * @param string $email   User email.
     * @param string $name   User name.
     * @param string $information   User information.
     * @param int $id   User id.
     *
     */
    public function __construct($email, $name, $information, $id)
    {
        parent::__construct([], [
            'id' => [
                'type'        => 'hidden',
                'required'    => true,
                'value'       => $id,
                'validation'  => ['not_empty'],
            ],
            'name' => [
                'type'        => 'text',
                'label'       => 'Namn:',
                'required'    => true,
                'value'       => $name,
                'validation'  => ['not_empty'],
                'class'       => 'formname',
            ],
            'information' => [
                'type'        => 'textarea',
                'label'       => 'Om mig:',
                'value'       => $information,
                'class'       => 'formcontent',
            ],
            'email' => [
                'type'        => 'text',
                'label'       => 'Email:',
                'required'    => true,
                'value'       => $email,
                'validation'  => ['not_empty', 'email_adress'],
                'class'       => 'formmail',
            ],
            'submit' => [
                'type'      => 'submit',
                'value'     => 'Spara',
                'callback'  => [$this, 'callbackSubmit'],
            ],
            'submit-reset' => [
                'type'      => 'reset',
                'value'     => 'Återställ',
            ],
        ]);
    }



    /**
     * Customise the check() method.
     *
     * @param callable $callIfSuccess handler to call if function returns true.
     * @param callable $callIfFail    handler to call if function returns true.
     */
    public function check($callIfSuccess = null, $callIfFail = null)
    {
        return parent::check([$this, 'callbackSuccess'], [$this, 'callbackFail']);
    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmit()
    {
        $this->user = new \Anax\Users\User();
        $this->user->setDI($this->di);
        $saved = $this->user->save([
            'id'        => $this->Value('id'),
            'name'      => $this->Value('name'),
            'email'     => $this->Value('email'),
            'information' => $this->Value('information')
            ]);
        return $saved ? true : false;
    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFail()
    {
        $this->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
        return false;
    }



    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
        $this->redirectTo('users/id/' . $this->Value('id'));
    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        $this->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
        $this->redirectTo();
    }
}
