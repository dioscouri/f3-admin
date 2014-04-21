<?php 
namespace Admin\Controllers;

class Menu extends BaseAuth 
{
    use \Dsc\Traits\Controllers\OrderableItemCollection {
        doAdd as doAddCrudItem;
        doUpdate as doUpdateCrudItem;
        doDelete as doDeleteCrudItem;
        doMoveUp as doMoveUpCrudItem;
        doMoveDown as doMoveDownCrudItem;
    }
    
    protected $list_route = '/admin/menus/{menu}';
    protected $create_item_route = '/admin/menus/{menu}';
    protected $get_item_route = '/admin/menu/read/{id}';
    protected $edit_item_route = '/admin/menu/edit/{id}';
        
    protected function doAdd($data)
    {
        $tree = !empty($data['tree']) ? $data['tree'] : null;
        
        if (!empty($data['is_root'])) 
        {
            $data['is_root'] = true;
            $data['tree'] = new \MongoId();
        }
        
        if ($return = $this->doAddCrudItem($data))
        {
            if (!empty($data['is_root']))
            {
                $tree = $this->item->id;
                                
                $this->item->tree = $tree;
                $this->item->save();
            }
        }
        
        $route = str_replace('{menu}', (string) $tree, $this->create_item_route );
        $this->setRedirect( $route );
        
        return $return;
    }
    
    protected function doUpdate(array $data, $key=null)
    {
        $tree = !empty($data['tree']) ? $data['tree'] : null;
        
        if ($return = $this->doUpdateCrudItem($data))
        {
            $tree = (string) $this->item->tree;
        }
                
        switch ($data['submitType'])
        {
        	case "save_close":
                $route = str_replace('{menu}', $tree, $this->create_item_route );
                $this->setRedirect( $route );
        	    break;
        }
        
        return $return;
    }
    
    protected function doDelete(array $data, $key=null)
    {
        $tree = !empty($data['tree']) ? $data['tree'] : null;
        
        if ($return = $this->doDeleteCrudItem($data, $key))
        {
            if (!empty($this->item->is_root)) {} else {
                $tree = (string) $this->item->tree;
            }
        }
    
        $route = str_replace('{menu}', $tree, $this->create_item_route );
        $this->setRedirect( $route );
    
        return $return;
    }
    
    protected function doMoveUp(array $data, $key=null)
    {
        $tree = !empty($data['tree']) ? $data['tree'] : null;
    
        if ($return = $this->doMoveUpCrudItem($data, $key))
        {
            if (!empty($this->item->is_root)) {} elseif (empty($tree) && !empty($this->item->tree)) {
                $tree = (string) $this->item->tree;
            }
        }
    
        $route = str_replace('{menu}', $tree, $this->create_item_route );
        $this->setRedirect( $route );
    
        return $return;
    }
    
    protected function doMoveDown(array $data, $key=null)
    {
        $tree = !empty($data['tree']) ? $data['tree'] : null;
    
        if ($return = $this->doMoveDownCrudItem($data, $key))
        {
            if (!empty($this->item->is_root)) {} else {
                $tree = (string) $this->item->tree;
            }
        }
    
        $route = str_replace('{menu}', $tree, $this->create_item_route );
        $this->setRedirect( $route );
    
        return $return;
    }
    
    protected function getModel() 
    {
        $model = new \Admin\Models\Navigation;
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
    
    protected function displayCreate() 
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Create Menu Item');

        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::menus/create.php');
    }
    
    protected function displayEdit()
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Edit Menu Item');
        
        $model = $this->getModel();
        $roots = $model->roots();
        $f3->set('roots', $roots );
        
        $all = $model->emptyState()->setState('list.sort', array( 'tree'=> 1, 'lft' => 1 ))->getList();
        $f3->set('all', $all );
        
        $view = \Dsc\System::instance()->get('theme');
        $view->event = $view->trigger( 'onDisplayAdminMenusEdit', array( 'item' => $this->getItem(), 'tabs' => array(), 'content' => array() ) );
        echo $view->renderTheme('Admin/Views::menus/edit.php');
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