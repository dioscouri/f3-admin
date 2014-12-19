<?php 
namespace Admin\Controllers;

class TrashItem extends BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItemCollection;
    
    protected $list_route = '/admin/trash/items';
    protected $create_item_route = '/admin/trash/item/create';
    protected $get_item_route = '/admin/trash/item/read/{id}';    
    protected $edit_item_route = '/admin/trash/item/edit/{id}';
    
    protected function getModel( $name = 'trash' ) 
    {
    	$model = null;
    	switch( $name ) {
    		case 'trash' :
    			$model = new \Dsc\Mongo\Collections\Trash;
    			break;
    	}
        return $model; 
    }
    
    protected function getItem() 
    {
        $id = $this->inputfilter->clean( $this->app->get('PARAMS.id'), 'alnum' );
        $model = $this->getModel()
            ->setState('filter.id', $id);

        try {
            $item = $model->getItem();
        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Invalid Item: " . $e->getMessage(), 'error');
            $this->app->reroute( $this->list_route );
            return;
        }

        return $item;
    }
    //no creating trash
    /**
     * This controller doesn't allow reading, only editing, so redirect to the edit method
     */
    protected function doCreate(array $data, $key=null)
    {
    	$this->app->reroute( $this->list_route );
    }
    protected function displayCreate() {}
  
    
    protected function displayEdit()
    {
        $item = $this->getItem();
        
        $this->app->set('meta.title', 'Edit Trashed Item | Trash');
        
        echo $view->render('Admin/Views::trash/edit.php');
    }
    
    /**
     * This controller doesn't allow reading, only editing, so redirect to the edit method
     */
    protected function doRead(array $data, $key=null) 
    {
        $id = $this->getItem()->get( $this->getItemKey() );
        $route = str_replace('{id}', $id, $this->edit_item_route );
        $this->app->reroute( $route );
    }
    
    protected function displayRead() {}
    
    public function restore() {
    	
    	//TODO try catch here
    	$this->getItem()->restore();
    	
    	\Dsc\System::instance()->addMessage( "Item was restored", 'success');
    	$this->app->reroute( $this->list_route );
    	
    }
    
   
}