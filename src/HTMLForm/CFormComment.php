<?php

namespace Anax\HTMLForm;

/**
 * Anax base class for wrapping sessions.
 *
 */
class CFormComment extends \Mos\HTMLForm\CForm
{
    use \Anax\DI\TInjectionaware,
        \Anax\MVC\TRedirectHelpers;



    /**
     * Constructor
     *
     * @param  $user  Specifies user.
     * @param  $categories   Specifies available categories.
     */
    public function __construct($user, $categories)
    {
        parent::__construct([], [
            'title' => [
                'type'        => 'text',
                'label'       => 'Titel på frågan:',
                'required'    => true,
                'validation'  => ['not_empty'],
                'class'       => 'formname',
            ],
            'content' => [
                'type'        => 'textarea',
                'label'       => 'Din fråga:',
                'required'    => true,
                'validation'  => ['not_empty'],
                'class'       => 'formcontent',
            ],
            'category' => [
                'class'          => 'formtags',
                'type'        => 'checkbox-multiple',
                'values'      => $categories,
                'label'       => 'Kryssa i taggar som passar ditt meddelande:',
            ],
            'user' => [
                'type'        => 'hidden',
                'value'       => $user,
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
        $this->comment = new \Anax\Comment\Comment();
        $this->comment->setDI($this->di);
        date_default_timezone_set('Europe/Berlin');
        $now = date('Y-m-d H:i:s');
        $saved = $this->comment->save([
            'title' => $this->Value('title'),
            'content' => $this->Value('content'),
            'timestamp' => $now,
            'user' => $this->Value('user')
            ]);
        if ($saved) {
            $this->lastcomment = $this->comment->lastId();
            $lastinserted = $this->comment->query()
                             ->orderBy('id DESC')
                             ->limit('1')
                             ->execute();
            $this->comment2category = new \Anax\Comment\Comment2category();
            $this->comment2category->setDI($this->di);
            $this->commentcategory = new \Anax\Comment\Commentcategory();
            $this->commentcategory->setDI($this->di);
            $this->users = new \Anax\Users\User();
            $this->users->setDI($this->di);
            
            $user = $this->users->query()
                    ->where('acronym = ?')
                    ->execute([$this->Value('user')]);
            $this->users->save([
                'id' => $user[0]->id,
                'fame' => $user[0]->fame + 10
                ]);            
            
            $categoriesundef = $this->commentcategory->findAll();
            $values = null;
            $this->Values('category') == false ? $values = array('Generellt') : $values = $this->Values('category');
            foreach ($categoriesundef as $cat => $thing) {
                if (in_array($thing->category, $values)) {
                    $saved = $this->comment2category->create([
                        'idComment' => $lastinserted[0]->id,
                        'idCategory' => (string)$cat+1
                    ]);
                }
            }
        }
        return $saved ? true : false;        
    }



    /**
     * Callback for submit-button.
     *
     */
    public function callbackSubmitFail()
    {
        $this->AddOutput("<p><i>Frågan kunde inte sparas.</i></p>");
        return false;
    }



    /**
     * Callback What to do if the form was submitted?
     *
     */
    public function callbackSuccess()
    {
        $url = 'comment/view-single/' . $this->lastcomment;
        $this->redirectTo($url);
    }



    /**
     * Callback What to do when form could not be processed?
     *
     */
    public function callbackFail()
    {
        $this->AddOutput("<p><i>Frågan kunde inte sparas.</i></p>");
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
