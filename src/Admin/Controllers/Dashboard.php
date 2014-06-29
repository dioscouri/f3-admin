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
    }
        
    public function index()
    {
        $this->app->set('meta.title', 'Home');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::dashboard/index.php');
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