<?php 
namespace Admin\Controllers;

class User extends BaseAuth 
{
    public function get()
    {
        $id = $this->inputfilter->clean( \Base::instance()->get('PARAMS.id'), 'alnum' );
        
        $model = new \Admin\Models\Users;
        $model->setState('filter.id', $id);
        $state = $model->getState();
        \Base::instance()->set('state', $state );

        try {
            $item = $model->getItem();
        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Invalid User: " . $e->getMessage(), 'error');
            \Base::instance()->reroute("/admin/users");
            return;            
        }
        
        \Base::instance()->set('item', $item );
        
        if (empty($item->_id) || $item->_id != $id) {
            \Dsc\System::instance()->addMessage('Invalid ID', 'error');
            \Base::instance()->reroute("/admin/users");
            return;
        }
        
        \Base::instance()->set('pagetitle', 'User Detail');
        \Base::instance()->set('subtitle', '');
        
        $view = new \Dsc\Template;
        echo $view->render('users/detail.php');
    }
    
    public function post()
    {
    
    }
    
    public function edit()
    {
        $id = $this->inputfilter->clean( \Base::instance()->get('PARAMS.id'), 'alnum' );
        
        $model = new \Admin\Models\Users;
        $model->setState('filter.id', $id);
        $state = $model->getState();
        \Base::instance()->set('state', $state );
        
        $item = $model->getItem();
        \Base::instance()->set('item', $item );

        if (empty($item->_id) || $item->_id != $id) {
            \Dsc\System::instance()->addMessage('Invalid ID', 'error');
            \Base::instance()->reroute("/admin/users");
            return;
        }
        
        \Base::instance()->set('pagetitle', 'Edit User');
        \Base::instance()->set('subtitle', '');
        
        $view = new \Dsc\Template;
        echo $view->render('users/edit.php');
    }
}