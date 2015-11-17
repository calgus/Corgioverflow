<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormUpdateComment extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor
     *
     */
    public function __construct($content, $name, $web, $mail, $id, $page)
    {
        parent::__construct([], [
            'id' => [
                'type'        => 'hidden',
                'required'    => true,
                'value'       => $id,
                'validation'  => ['not_empty'],
            ],
            'content' => [
                'type'        => 'textarea',
                'required'    => true,
                'label'       => 'Kommentar:',
                'value'       => $content,
                'validation'  => ['not_empty'],
                'class'       => 'formcontent',
            ],
            'name' => [
                'type'        => 'text',
                'label'       => 'Namn:',
                'required'    => true,
                'value'       => $name,
                'validation'  => ['not_empty'],
                'class'       => 'formname',
            ],
            'web' => [
                'type'        => 'url',
                'value'       => $web,
                'label'       => 'Hemsida',
                'class'       => 'formweb',
            ],
            'mail' => [
                'type'        => 'email',
                'value'       => $mail,
                'label'       => 'Email',
                'class'       => 'formmail',
            ],
            'page' => [
                'type'        => 'hidden',
                'value'       => $page,
            ],
            'submit' => [
                'type'      => 'submit',
                'value'     => 'Spara',
                'callback'  => [$this, 'callbackSubmit'],
            ],
            'submit-reset' => [
                'type'      => 'reset',
                'value'     => 'Ångra',
            ],
            'delete' => [
                'type'      => 'submit',
                'value'     => 'Radera',
                'callback'  => [$this, 'callbackDelete'],
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
        $this->comments = new \Anax\Comment\Comment();
        $this->comments->setDI($this->di);
        $saved = $this->comments->save([
            'id'        => $this->Value('id'),
            'content'   => $this->Value('content'),
            'name'      => $this->Value('name'),
            'web'       => $this->Value('web'),
            'mail'      => $this->Value('mail')
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
        $this->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
        $url = $this->Value('page') == 'main' ? '' : $this->Value('page');
        $this->redirectTo($url);
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
    
    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackDelete()
    {
        $this->comments = new \Anax\Comment\Comment();
        $this->comments->setDI($this->di);
        $res = $this->comments->delete($this->Value('id'));
        return $res ? true : false;
    }
}
