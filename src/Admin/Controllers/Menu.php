<?php 
namespace Admin\Controllers;

class Menu extends BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItem {
        doAdd as doAddCrudItem;
        doUpdate as doUpdateCrudItem;
        doDelete as doDeleteCrudItem;
    }
    
    protected $list_route = '/admin/menus/{menu}';
    protected $create_item_route = '/admin/menus/{menu}';
    protected $get_item_route = '/admin/menu/{id}';
    protected $edit_item_route = '/admin/menu/{id}/edit';
        
    protected function doAdd($data)
    {
        $tree = !empty($data['tree']) ? $data['tree'] : null;
        
        if (!empty($data['is_root'])) 
        {
            $data['is_root'] = true;
            $data['tree'] = $data['title'];
        }
        
        if ($return = $this->doAddCrudItem($data))
        {
            if (!empty($data['is_root']))
            {
                $tree = (string) $this->item->id;
                                
                $this->item->tree = $tree;
                $this->item->save();
            }
        }
        
        $route = str_replace('{menu}', $tree, $this->create_item_route );
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
    
    protected function getModel() 
    {
        $model = new \Admin\Models\Menus;
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
        $f3->set('pagetitle', 'Create Menu');
        
        $view = new \Dsc\Template;
        echo $view->render('Admin/Views::menus/create.php');        
    }
    
    protected function displayEdit()
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Edit Menu');
        
        $model = $this->getModel();
        $parents = $model->getParents();
        $f3->set('parents', $parents );
        
        $view = new \Dsc\Template;
        echo $view->render('Admin/Views::menus/edit.php');
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
    
    public function quickadd() 
    {
    	$model = $this->getModel();
    	$categories = $model->getList();
    	\Base::instance()->set('categories', $categories );
    	
    	$view = new \Dsc\Template;
    	echo $view->renderLayout('Admin/Views::menus/quickadd.php');
    }
}