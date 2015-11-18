<?php
namespace Anax\Users;
 
/**
 * A controller for users and admin related events.
 *
 */
class UsersController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;

    /**
     * Initialize the controller.
     *
     * @return void
     */
    public function initialize()
    {
        $this->vusers = new \Anax\Users\Vuser();
        $this->vusers->setDI($this->di);
        $this->vcomments = new \Anax\Comment\Vcomments();
        $this->vcomments->setDI($this->di);
        $this->vanswers = new \Anax\Comment\Vanswers();
        $this->vanswers->setDI($this->di);
    }

    /**
     * List all users.
     *
     * @return void
     */
    public function allAction()
    {   
        $all = $this->vusers->findAll();
     
        $this->theme->setTitle("Corgimänniskor");
        $this->views->add('users/users', [
            'users' => $all,
        ]);
    }
    
    /**
     * List top users by their fame limited to 5.
     *
     * @return void
     */
    public function topUsersAction()
    {   
        $all = $this->vusers->query()
                    ->orderBy('fame DESC')
                    ->limit('5')
                    ->execute();
     
        $this->views->add('users/usersfront', [
            'title' => 'Corgifanatiker',
            'users' => $all,
        ], 'sidebar');
    }
    
    /**
     * List top users by their comments limited to 5.
     *
     * @return void
     */
    public function topUsersCommentAction()
    {   
        $all = $this->vusers->query()
                    ->orderBy('comments DESC')
                    ->limit('5')
                    ->execute();
     
        $this->views->add('users/usersfront', [
            'title' => 'Frågar mest',
            'users' => $all,
        ], 'sidebar');
    }
    
    /**
     * List user with id.
     *
     * @param int $id of user to display
     *
     * @return void
     */
    public function idAction($id = null)
    { 
        $user = $this->vusers->find($id);
        
        if ($user) {
            $answerarray = array();
            
            $comments = $this->vcomments->query()
                        ->where('user = ?')
                        ->execute([$user->user]);

            $answers = $this->vanswers->query()
                            ->where('user = ?')
                            ->execute([$user->user]);
 
            if ($answers || $comments) {  
                $answerscomp = '';
                if ($answers) {
                    foreach ($answers as $id => $answer) {
                        array_push($answerarray, $answer->answerto);
                        if ($id == 0) {
                            $questionmark = '?';    
                        } else {
                            $questionmark .= ', ?';    
                        }
                    } 
                    $answerscomp = $this->vcomments->query()
                                        ->where('id IN (' . $questionmark . ')')
                                        ->execute($answerarray);
                }
                $fame = $user->fame + (($user->comments + $user->commentPoints) * 10) + (($user->answers + $user->answerPoints) * 7) + (($user->replies + $user->replyPoints) * 3);
                
                
                $loggeduser = $this->session->get('user');
                
                $this->theme->setTitle($user->user);
                $this->views->add('users/viewuser', [
                    'user' => $user,
                    'comments' => $comments,
                    'answers' => $answerscomp, 
                    'loggeduser' => $loggeduser,
                ]);
            } else {
                $this->di->theme->setTitle($user->user);
                $loggeduser = $this->session->get('user');
                $this->views->add('users/viewuser', [
                    'user' => $user,
                    'comments' => '',
                    'answers' => '', 
                    'loggeduser' => $loggeduser,
                ]);                
            }
            
            
            

        } else {
            $this->views->add('default/page', [
                'title' => 'Användaren finns inte.',
                'content' => 'Har du jagat fel ben?',
            ]);            
        }
    }
    
    /**
     * Add new user.
     *
     *
     * @return void
     */
    public function addAction()
    {
        $addform = new \Anax\HTMLForm\CFormSignup();
        $addform->setDI($this->di);
        
        $status = $addform->check();
        
        
        $this->di->theme->setTitle("Skapa användare");
        $this->di->views->add('comment/edit', [
            'title'     => 'Skapa användare',
            'content'   => $addform->getHTML()
            ]);
    }

    /**
     * Controls login form and status.
     *
     *
     * @return void
     */
    public function loginAction()
    {
        $addform = new \Anax\HTMLForm\CFormLogin();
        $addform->setDI($this->di);
        
        $status = $addform->check();
        
        if ($this->session->has('user')) {
            $this->di->theme->setTitle($this->session->get('user'));
            $userid = $this->vusers->query()
                                   ->where('user = ?')
                                   ->execute([$this->session->get('user')]);
            $this->dispatcher->forward([
                'controller' => 'users',
                'action'     => 'id',
                'params'     => [$userid[0]->id],
            ]);  
        } else {
            $this->di->theme->setTitle("Logga in");
            $this->di->views->add('users/edit', [
                'content'   => $addform->getHTML(),
                ]);
            $this->views->add('users/edit', [
                'content'   => '',
                'links'     => [
                    [
                        'topic' => 'Inte medlem än?',
                        'href' => $this->url->create('users/add'),
                        'text' => 'Bli medlem här...',
                    ],
                ],                
                ], 'sidebar');
        }
    }
    
    /**
     * User logout.
     *
     * @param int $id of user to log out.
     *
     * @return void
     */
    public function logoutAction($id)
    {
        $this->session->delete('user');
        $url = $this->url->create('users/id/' . $id);
        $this->response->redirect($url);
    }
    
    /**
     * Update user.
     *
     *
     * @return void
     */
    public function updateAction()
    {
        if ($this->session->has('user')) {
            $user = $this->vusers->query()
                        ->where('user = ?')
                        ->execute([$this->session->get('user')]);
            $email = $user[0]->email;
            $name = $user[0]->name;
            $id = $user[0]->id;
            $information = $user[0]->information;
            
            $updateform = new \Anax\HTMLForm\CFormUpdate($email, $name, $information, $id);
            $updateform->setDI($this->di);
            $updateform->check();
            
            $this->di->theme->setTitle("Uppdatera användare");
            $this->di->views->add('users/edit', [
                'title' => "Uppdatera användare:",
                'content' => $updateform->getHTML()
            ]);
        }


    }
}
