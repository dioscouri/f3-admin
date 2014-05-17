<?php 
namespace Admin\Controllers;

class Home extends BaseAuth 
{
    public function display()
    {
        $this->app->set('meta.title', 'Home');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::home/default.php');
    }
}
?> 