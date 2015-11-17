<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormReply extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor
     *
     * @param  $page  passes current page.
     * @param  $ip    passes ip for comment.
     */
    public function __construct($answerto, $user, $replytype)
    {
        parent::__construct([], [
            'content' => [
                'type'        => 'textarea',
                'label'       => 'Kommentar:',
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
                'value'        => $answerto,
            ],
            'replytype' => [
                'type'        => 'hidden',
                'value'       => $replytype,
            ],
            'submitnew' => [
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
        $this->commentreplies = new \Anax\Comment\Commentreply();
        $this->commentreplies->setDI($this->di);
        $this->users = new \Anax\Users\User();
        $this->users->setDI($this->di);
        
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');

        $user = $this->users->query()
                ->where('acronym = ?')
                ->execute([$this->Value('user')]);
        $this->users->save([
            'id' => $user[0]->id,
            'fame' => $user[0]->fame + 3
            ]);  
        
        $saved = $this->commentreplies->save([
            'content' => $this->Value('content'),
            'timestamp' => $now,
            'user' => $this->Value('user'),
            'answerto' => $this->Value('answerto'),
            'replytype' => $this->Value('replytype')
            ]);
        return $saved ? true : false;        
    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFail()
    {
        return false;
    }



    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
        if ($this->Value('replytype') == "answer") {
            $this->vanswers = new \Anax\Comment\Vanswers();
            $this->vanswers->setDI($this->di);
            $answer = $this->vanswers->find($this->Value('answerto'));
            $this->redirectTo('comment/view-single/' . $answer->answerto . "#" . $this->Value('answerto'));
        } else {
            $this->redirectTo('comment/view-single/' . $this->Value('answerto'));
        }
    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
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
