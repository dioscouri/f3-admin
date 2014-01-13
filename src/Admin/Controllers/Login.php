<?php 
namespace Admin\Controllers;

class Login extends Base 
{
    public function login()
    {
        $user = \Base::instance()->get('SESSION.user');
        if(!empty($user)){
            \Base::instance()->reroute('/admin');
        }
                
        \Base::instance()->set('pagetitle', 'Login');
        \Base::instance()->set('subtitle', '');

        $view = new \Dsc\Template;
        $view->setLayout('login.php');
        echo $view->render('common/login.php');
    }
    
    public function auth()
    {
        $username_input = $this->input->getAlnum('login-username');
        $password_input = $this->input->getString('login-password');
        
        if (empty($username_input) || empty($password_input)) 
        {
            \Dsc\System::instance()->addMessage('Login failed - Incomplete Form', 'error');
            \Base::instance()->reroute("/admin/login");
            return;
        }
        
        // check if safemode is being used
        $safemode_enabled = \Base::instance()->get('safemode.enabled');
        $safemode_user = \Base::instance()->get('safemode.user');
        $safemode_salt = \Base::instance()->get('safemode.salt');
        $safemode_password = \Base::instance()->get('safemode.password');

        $simple = new \Joomla\Crypt\Password\Simple;
        if ($safemode_enabled && $username_input === $safemode_user) 
        {
            if ($simple->verify($password_input, $safemode_password)) 
            {
                $user = new \Users\Objects\SafemodeUser;
                $user->id = 'safemode';
                $user->name = $safemode_user;
                $user->username = $safemode_user;
                $user->password = $safemode_password;
                $user->email = "safemode@localhost";
                
                \Base::instance()->set('SESSION.user', $user);
                \Base::instance()->reroute("/admin");
                return;
            }
        }
        
        // TODO Fire the authentication Listeners, or let an auth model handle that?
        
        $model = new \Users\Admin\Models\Users;
        $model->setState('filter.username', $username_input);

        try {
            $item = $model->getItem();
        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage("Invalid User: " . $e->getMessage(), 'error');
            \Base::instance()->reroute("/admin/users");
            return;
        }
        
        if ($simple->verify($password_input, $item->password))
        {
            \Base::instance()->set('SESSION.user', $item);
            \Base::instance()->reroute("/admin");
            return;            
        }
        
        \Dsc\System::instance()->addMessage('Login failed', 'error');
        \Dsc\System::instance()->addMessage('Invalid Password', 'error');
        \Base::instance()->reroute("/admin/login");
        return;            
    }
    
    public function logout()
    {
        \Base::instance()->clear('SESSION');
        \Base::instance()->reroute('/admin/login');
    }

}
?> 