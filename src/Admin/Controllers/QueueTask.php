<?php 
namespace Admin\Controllers;

class QueueTask extends BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItemCollection;
    
    protected $list_route = '/admin/queue/tasks';
    protected $create_item_route = '/admin/queue/task/create';
    protected $get_item_route = '/admin/queue/task/read/{id}';    
    protected $edit_item_route = '/admin/queue/task/edit/{id}';
    
    protected function getModel( $name = 'post' ) 
    {
    	$model = null;
    	switch( $name ) {
    		case 'post' :
    			$model = new \Dsc\Mongo\Collections\QueueTasks;
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
    
    protected function displayCreate() 
    {
        $item = $this->getItem();
        
        $this->app->set('meta.title', 'Create Task | Queue');
        
        $view = \Dsc\System::instance()->get('theme');
        $view->event = $view->trigger( 'onDisplayQueueTaskEdit', array( 'item' => $item, 'tabs' => array(), 'content' => array() ) );
        echo $view->render('Admin/Views::queuetasks/create.php');
    }
    
    protected function displayEdit()
    {
        $item = $this->getItem();
        
        $this->app->set('meta.title', 'Edit Task | Queue');
        
        $view = \Dsc\System::instance()->get('theme');
        $view->event = $view->trigger( 'onDisplayQueueTaskEdit', array( 'item' => $item, 'tabs' => array(), 'content' => array() ) );
        
        echo $view->render('Admin/Views::queuetasks/edit.php');
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
    
    public function process()
    {
        try 
        {
            $item = $this->getItem();
            
            if (empty($item->id)) {
                throw new \Exception('Invalid ID');
            }
            
            // if the task is already locked by another process, fail
            if (!empty($item->locked_by)) {
                throw new \Exception('Task locked by another process');
            }
            
            // lock the task to this process
            $mongo_id = (string) new \MongoId;
            $item->locked_by = $mongo_id;
            $item->locked_at = time();
            $item->store();
            
            // run the task
            $this->app->call( $item->task, $item->parameters );
            $task = $item->complete();
            
            \Dsc\System::addMessage( 'Task completed', 'success' );
            
        }
        catch (\Exception $e) 
        {
            \Dsc\System::addMessage( $e->getMessage(), 'error' );
        }

        $this->app->reroute( $this->list_route );
    }
}