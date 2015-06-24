<?php 
namespace Admin\Controllers;

class Dashboard extends BaseAuth 
{
    public function beforeRoute()
    {
        parent::beforeRoute();
        
        $settings = \Admin\Models\Settings::fetch();
        
        if (empty($settings->admin_menu_id)) 
        {
             $this->session->set('rebuild-menu.redirect', '/admin');
             return $this->app->reroute( '/admin/system/rebuildAdminMenu' );
        }
        
        if (class_exists('\Mailer\Factory')) {
            $mailer_settings = \Mailer\Models\Settings::fetch();
            if (!$mailer_settings->emails_registered || (date('Y-m-d', time()) > date('Y-m-d', $mailer_settings->emails_registered))) 
            {
                $result = \Dsc\System::instance()->trigger('onSystemRegisterEmails');
                
                $mailer_settings->{'emails_registered'} = time();
                $mailer_settings->save();
            }
        }
    }
        
    public function index()
    {
        $this->app->set('meta.title', 'Home');
        
        if ($this->app->get('DEBUG')) 
        {
            echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::dashboard/index.php');
        } 
        else 
        {
            echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::dashboard/index.php');
        }
        
    }
    
    public function today()
    {
        // TODO Set state
        $this->app->set('active', 'today');
    
        $this->index();
    }
    
    public function yesterday()
    {
        // TODO Set state
        $this->app->set('active', 'yesterday');
        
        $this->index();
    }
    
    public function last7()
    {
        // TODO Set state
        $this->app->set('active', 'last7');
        
        $this->index();
    }
    
    public function last30()
    {
        // TODO Set state
        $this->app->set('active', 'last30');
    
        $this->index();
    }    
    
    public function last90()
    {
        // TODO Set state
        $this->app->set('active', 'last90');
        
        $this->index();
    }    
    
    public function custom()
    {
        // TODO Set state
        $this->app->set('active', 'custom');
    
        $this->index();
    }    
}
?> 