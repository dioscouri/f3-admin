<?php 
namespace Admin\Controllers;

class Logs extends BaseAuth 
{
    public function index()
    {
        $model = new \Dsc\Mongo\Collections\Logs;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $paginated = $model->paginate();
        \Base::instance()->set('paginated', $paginated);
        
        $this->app->set('meta.title', 'Logs');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::logs/list.php');
    }
}