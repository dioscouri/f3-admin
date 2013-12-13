<?php 
namespace Admin\Controllers;

class Home extends BaseAuth 
{
    public function display()
    {
        \Base::instance()->set('pagetitle', 'Dashboard');
        \Base::instance()->set('subtitle', '');
                
        $view = new \Dsc\Template;
        echo $view->render('home/default.php');
    }
}
?> 