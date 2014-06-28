<?php 
namespace Admin\Controllers;

class Home extends BaseAuth 
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
        
    public function display()
    {
        $this->app->set('meta.title', 'Home');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::home/index.php');
    }
}
?> 