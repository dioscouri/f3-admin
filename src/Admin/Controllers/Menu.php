<?php 
namespace Admin\Controllers;

class Menu extends BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItem;

    protected $list_route = '/admin/menus';
    protected $create_item_route = '/admin/menu';
    protected $get_item_route = '/admin/menu/{id}';    
    protected $edit_item_route = '/admin/menu/{id}/edit';
    
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
        $f3->set('pagetitle', 'Edit Menu');
        
        $view = new \Dsc\Template;
        echo $view->render('Admin/Views::menus/create.php');        
    }
    
    protected function displayEdit()
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Edit Menu');
        
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