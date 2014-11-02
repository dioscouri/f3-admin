<?php 
namespace Admin\Controllers;

class Menus extends BaseAuth 
{
    protected function getModel()
    {
        $model = new \Admin\Models\Navigation;
        return $model;
    }
    
    
    
    public function index()
    {
        $f3 = \Base::instance();
        
        $model = $this->getModel();
        
        $roots = \Admin\Models\Navigation::roots();
        $f3->set('roots', $roots );
        
        $id = $this->inputfilter->clean( $f3->get('PARAMS.id'), 'alnum' );
        $f3->set('selected', $id );
        $f3->set('tree', $id );
        
        if ($id) {
            
            $item = (new \Admin\Models\Navigation)->emptyState()->setState('filter.root', true)->setState('filter.id', $id)->getItem();
            $f3->set('item', $item );

            $paginated = $model->emptyState()->populateState()->setState('filter.root', false)->setState('filter.id', null)->setState('filter.tree', $id)->setState('list.sort', array( 'tree'=> 1, 'lft' => 1 ))->paginate();
            $f3->set('state', $model->getState() );
            $f3->set('paginated', $paginated );
        }
        
        $event = new \Joomla\Event\Event( 'onAdminNavigationGetQuickAddItems' );
        $event->addArgument('items', array());
        $event->addArgument('tree', $id);
        $quickadd = \Dsc\System::instance()->getDispatcher()->triggerEvent($event);
        $f3->set('quickadd', $quickadd);
        
        $model = $this->getModel();
        $roots = $model->roots();
        $this->app->set('roots', $roots );
        
        $all = $model->emptyState()->setState('list.sort', array( 'tree'=> 1, 'lft' => 1 ))->getList();
        $this->app->set('all', $all );
        
        
        $this->app->set('meta.title', 'Menus');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::menus/manage.php');
    }
    
    public function getAll()
    {
        $model = $this->getModel();
        $roots = \Admin\Models\Navigation::roots();
        \Base::instance()->set('roots', $roots );
    
        \Base::instance()->set('selected', 'null' );

        $html = \Dsc\System::instance()->get('theme')->renderView('Admin/Views::menus/list_parents.php');
    
        return $this->outputJson( $this->getJsonResponse( array(
                'result' => $html
        ) ) );
    
    }
}