<?php 
namespace Admin\Controllers;

class QueueArchives extends BaseAuth 
{
    public function index()
    {
        $model = new \Dsc\Mongo\Collections\QueueArchives;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $paginated = $model->paginate();
        \Base::instance()->set('paginated', $paginated);
        
        $this->app->set('meta.title', 'Queue Archives');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::queuearchives/list.php');
    }
}