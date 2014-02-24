<?php 
namespace Admin\Controllers;

class Home extends BaseAuth 
{
    public function display()
    {
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::home/default.php');
    }
}
?> 