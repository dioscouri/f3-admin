<?php 
namespace Admin\Controllers;

class Settings extends BaseAuth 
{
    public function index()
    {
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::settings/default.php');
    }
    
    public function save()
    {
        \Base::instance()->reroute("/admin/settings");
    }
}