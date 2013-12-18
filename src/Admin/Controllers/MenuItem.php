<?php 
namespace Admin\Controllers;

class MenuItem extends \Admin\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItem {
        doAdd as doAddCrudItem;
        doDelete as doDeleteCrudItem;
    }

    protected $list_route = '/admin/menus/{menu}';
    protected $create_item_route = '/admin/menus/{menu}';
    protected $get_item_route = '/admin/menuitem/{id}';    
    protected $edit_item_route = '/admin/menuitem/{id}/edit';
    
    protected function getModel() 
    {
        $model = new \Admin\Models\MenuItems;
        return $model; 
    }
    
    protected function getItem() 
    {
        $f3 = \Base::instance();
        $id = $this->inputfilter->clean( $f3->get('PARAMS.id'), 'alnum' );
        $model = $this->getModel()
            ->setState('filter.id', $id);

        try {
            $item = $model->getItem();
        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Invalid Item: " . $e->getMessage(), 'error');
            $f3->reroute( $this->list_route );
            return;
        }

        return $item;
    }
    
    protected function doAdd($data)
    {
        if ($return = $this->doAddCrudItem($data)) 
        {
            $menu = $this->item->tree;
            $route = str_replace('{menu}', $menu, $this->create_item_route );
                        
            $this->setRedirect( $route );
        }
        
        return $return;
    }
    
    protected function doDelete($data, $key)
    {
        if ($return = $this->doDeleteCrudItem($data))
        {
            $menu = $this->item->tree;
            $route = str_replace('{menu}', $menu, $this->create_item_route );
    
            $this->setRedirect( $route );
        }
    
        return $return;
    }
    
    protected function displayCreate() 
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Create Menu Item');

        $view = new \Dsc\Template;
        echo $view->render('Admin/Views::home/default.php');        
    }
    
    protected function displayEdit()
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Edit Menu Item');
        
        $view = new \Dsc\Template;
        echo $view->render('Admin/Views::menuitem/edit.php');
    }
    
    /**
     * This controller doesn't allow reading, only editing, so redirect to the edit method
     */
    protected function doRead(array $data, $key=null) 
    {
        $f3 = \Base::instance();
        $id = $this->getItem()->get( $this->getItemKey() );
        $route = str_replace('{id}', $id, $this->edit_item_route );
        $f3->reroute( $route );
    }
    
    protected function displayRead() {}

}