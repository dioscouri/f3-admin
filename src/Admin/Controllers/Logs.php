<?php 
namespace Admin\Controllers;

class Logs extends BaseAuth 
{
    public function index()
    {
        \Base::instance()->set('pagetitle', 'Logs');
        \Base::instance()->set('subtitle', '');

        $model = new \Dsc\Mongo\Collections\Logs;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $paginated = $model->paginate();
        \Base::instance()->set('paginated', $paginated);
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::logs/list.php');
    }
}