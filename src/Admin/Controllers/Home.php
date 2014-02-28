<?php 
namespace Admin\Controllers;

class Home extends BaseAuth 
{
    public function display()
    {
        $this->checkAccess( __CLASS__, __FUNCTION__ );
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::home/default.php');
    }
}
?> 