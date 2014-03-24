<?php 
namespace Admin\Controllers;

class Login extends Base 
{
    public function login()
    {
        $user = \Base::instance()->get('SESSION.admin.user');
        if(!empty($user)){
            \Base::instance()->reroute('/admin');
        }
        
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
        
        // TODO Push this to the \Users\Lib\Auth class, and let it run through any Auth listeners
        $input = $this->input->getArray();
        
        try {
            
            $this->auth->check($input);
            \Base::instance()->reroute("/admin");
            return;
            
        } catch (\Exception $e) {
            \Dsc\System::instance()->addMessage('Login failed', 'error');
            \Dsc\System::instance()->addMessage($e->getMessage(), 'error');
            \Base::instance()->reroute("/admin/users");
            return;
        }

        \Base::instance()->reroute("/admin");
        return;            
    }
    
    public function logout()
    {
        \Dsc\System::instance()->get('auth')->logout();
        \Base::instance()->reroute('/admin/login');
    }

}
?> 