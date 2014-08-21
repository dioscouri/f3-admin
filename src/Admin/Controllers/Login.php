<?php 
namespace Admin\Controllers;

class Login extends Base 
{
    public function login()
    {
        $user = $this->getIdentity();
        if (!empty($user->id))
        {
            $this->app->reroute('/admin');
        }
        
        $this->app->set('meta.title', 'Login');
        
        echo \Dsc\System::instance()->get('theme')->setVariant('login')->renderTheme('Admin/Views::common/login.php');
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
        
        $input = $this->input->getArray();
        
        try {
            
            $this->auth->check($input);
            
        } catch (\Exception $e) {
            \Dsc\System::instance()->addMessage('Login failed', 'error');
            \Dsc\System::instance()->addMessage($e->getMessage(), 'error');
            \Base::instance()->reroute("/admin/login");
            return;
        }

        $redirect = '/admin';
        if ($custom_redirect = \Dsc\System::instance()->get( 'session' )->get( 'admin.login.redirect' ))
        {
            $redirect = $custom_redirect;
            \Dsc\System::instance()->get( 'session' )->set( 'admin.login.redirect', null );
        }
        \Base::instance()->reroute($redirect);
        
        return;            
    }
    
    public function logout()
    {
        \Dsc\System::instance()->get('auth')->logout();
        \Base::instance()->reroute('/admin/login');
    }

}
?> 