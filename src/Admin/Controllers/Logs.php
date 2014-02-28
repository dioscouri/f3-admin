<?php 
namespace Admin\Controllers;

class Logs extends BaseAuth 
{
    public function index()
    {
        \Base::instance()->set('pagetitle', 'Logs');
        \Base::instance()->set('subtitle', '');

        $model = new \Admin\Models\Logs;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $list = $model->paginate();
        \Base::instance()->set('list', $list );
    
        $pagination = new \Dsc\Pagination($list['total'], $list['limit']);
        \Base::instance()->set('pagination', $pagination );
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::logs/list.php');
    }
}