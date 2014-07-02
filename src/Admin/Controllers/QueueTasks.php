<?php 
namespace Admin\Controllers;

class QueueTasks extends BaseAuth 
{
    public function index()
    {
        $model = new \Dsc\Mongo\Collections\QueueTasks;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $paginated = $model->paginate();
        \Base::instance()->set('paginated', $paginated);
        
        $this->app->set('meta.title', 'Queue Tasks');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::queuetasks/list.php');
    }
}