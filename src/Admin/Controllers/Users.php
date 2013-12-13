<?php 
namespace Admin\Controllers;

class Users extends BaseAuth 
{
    public function display()
    {
        \Base::instance()->set('pagetitle', 'Users');
        \Base::instance()->set('subtitle', '');
    
        $model = new \Admin\Models\Users;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $list = $model->paginate();
        \Base::instance()->set('list', $list );
    
        $pagination = new \Dsc\Pagination($list['total'], $list['limit']);
        \Base::instance()->set('pagination', $pagination );
    
        $view = new \Dsc\Template;
        echo $view->render('users/list.php');
    }
}