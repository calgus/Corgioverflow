<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormAnswer extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor
     *
     * @param  $page  passes current page.
     * @param  $ip    passes ip for comment.
     */
    public function __construct($user, $answerto)
    {
        parent::__construct([], [
            'content' => [
                'type'        => 'textarea',
                'label'       => 'Svar:',
                'required'    => true,
                'validation'  => ['not_empty'],
                'class'       => 'formcontent',
            ],
            'user' => [
                'type'        => 'hidden',
                'value'       => $user,
            ],
            'answerto' => [
                'type'        => 'hidden',
                'value'       => $answerto,
            ],
            'submit' => [
                'type'      => 'submit',
                'value'     => 'Skapa',
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
        $this->commentanswers = new \Anax\Comment\Commentanswer();
        $this->commentanswers->setDI($this->di);
        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);
        
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
 
        $user = $this->users->query()
                ->where('acronym = ?')
                ->execute([$this->Value('user')]);
        $this->users->save([
            'id' => $user[0]->id,
            'fame' => $user[0]->fame + 7
            ]);      
        
        $saved = $this->commentanswers->save([
            'content' => $this->Value('content'),
            'timestamp' => $now,
            'user' => $this->Value('user'),
            'answerto' => $this->Value('answerto')
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
        $this->AddOutput("<p><i>Form was submitted and the callback method returned true.</i></p>");     
        $this->redirectTo();
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
    public function callbackResetComments()
    {
        $this->redirectTo();
        return true;
    }
}
