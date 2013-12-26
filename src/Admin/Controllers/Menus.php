<?php 
namespace Admin\Controllers;

class Menus extends BaseAuth 
{
    protected function getModel()
    {
        $model = new \Admin\Models\Menus;
        return $model;
    }
    
    public function display()
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Edit Menus');
        
        $model = $this->getModel();
        $roots = $model->getRoots();
        $f3->set('roots', $roots );
        
        $id = $this->inputfilter->clean( $f3->get('PARAMS.id'), 'alnum' );
        $f3->set('selected', $id );
        $f3->set('tree', $id );
        
        $list = array();
        if ($id) {
            
            $item = $model->emptyState()->setState('filter.root', true)->setState('filter.id', $id)->getItem();
            $f3->set('item', $item );

            $list = $model->emptyState()->populateState()->setState('filter.root', false)->setState('filter.tree', $id)->setState('order_clause', array( 'tree'=> 1, 'lft' => 1 ))->paginate();
            $f3->set('state', $model->getState() );
            
            $pagination = new \Dsc\Pagination($list['total'], $list['limit']);
            $f3->set('pagination', $pagination );
        }
        $f3->set('list', $list );
        
        $event = new \Joomla\Event\Event( 'onAdminNavigationGetQuickAddItems' );
        $event->addArgument('items', array());
        $event->addArgument('tree', $id);
        $quickadd = \Dsc\System::instance()->getDispatcher()->triggerEvent($event);
        $f3->set('quickadd', $quickadd);
        
        $view = new \Dsc\Template;
        echo $view->render('Admin/Views::menus/manage.php');
    }
    
    public function getAll()
    {
        $model = $this->getModel();
        $roots = $model->getRoots();
        \Base::instance()->set('roots', $roots );
    
        \Base::instance()->set('selected', 'null' );
    
        $view = new \Dsc\Template;
        $html = $view->renderLayout('Admin/Views::menus/list_parents.php');
    
        return $this->outputJson( $this->getJsonResponse( array(
                        'result' => $html
        ) ) );
    
    }
}