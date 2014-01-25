<?php 
namespace Admin\Controllers;

class System extends BaseAuth 
{
    public function rebuildAdminMenu() 
    {
        $model = new \Admin\Models\Nav\Primary;
        $mapper = $model->getMapper();
        
        $model->drop(); // delete the menu
        
        $event = new \Joomla\Event\Event( 'onSystemRebuildMenu' );
        $event->addArgument('model', $model);
        $event->addArgument('mapper', $mapper);
        \Dsc\System::instance()->getDispatcher()->triggerEvent($event); 

        $mapper->reset();
        $mapper->priority = 99;
        $mapper->title = 'Navigation';
        $mapper->route = '';
        $mapper->icon = 'fa fa-tasks';
        $mapper->children = array(
        		json_decode(json_encode(array( 'title'=>'Menus', 'route'=>'/admin/menus', 'icon'=>'fa fa-list' )))
        		,json_decode(json_encode(array( 'title'=>'Add New Menu', 'route'=>'/admin/menu', 'icon'=>'fa fa-plus', 'hidden'=>true )))
        		,json_decode(json_encode(array( 'title'=>'Menu Items', 'route'=>'/admin/menus/items', 'icon'=>'fa fa-sitemap', 'hidden'=>true )))
        		,json_decode(json_encode(array( 'title'=>'Add New Menu Item', 'route'=>'/admin/menus/item', 'icon'=>'fa fa-plus', 'hidden'=>true )))
        );
        $mapper->save();
        
        $mapper->reset();
        $mapper->priority = 100;
        $mapper->title = 'System';
        $mapper->route = '';
        $mapper->icon = 'fa fa-cogs';
        $mapper->children = array(
                json_decode(json_encode(array( 'title'=>'Settings', 'route'=>'/admin/settings', 'icon'=>'fa fa-cogs' )))
                ,json_decode(json_encode(array( 'title'=>'Rebuild Admin Menu', 'route'=>'/admin/system/rebuildAdminMenu', 'icon'=>'fa fa-retweet' )))
        		,json_decode(json_encode(array( 'title'=>'Diagnostics', 'route'=>'/admin/system/diagnostics', 'icon'=>'fa fa-heart' )))
                ,json_decode(json_encode(array( 'title'=>'Logs', 'route'=>'/admin/logs', 'icon'=>'fa fa-list' )))
                ,json_decode(json_encode(array( 'title'=>'Log Detail', 'route'=>'/admin/log', 'hidden'=>true )))
                ,json_decode(json_encode(array( 'title'=>'Queue', 'route'=>'/admin/queue', 'icon'=>'fa fa-refresh' )))
                ,json_decode(json_encode(array( 'title'=>'Queue Detail', 'route'=>'/admin/queueitem', 'hidden'=>true )))
        );
        $mapper->save();
        
        \Dsc\System::instance()->addMessage('Menu rebuilt', 'notice');
        
        \Base::instance()->set('pagetitle', 'System');
        \Base::instance()->set('subtitle', 'Rebuild Menu');
        
        $view = new \Dsc\Template;
        echo $view->render('home/default.php');
    }
    
    public function diagnostics()
    {
    	$event = new \Joomla\Event\Event( 'onSystemDiagnostics' );
    	$result = \Dsc\System::instance()->getDispatcher()->triggerEvent($event);

    	\Base::instance()->set('pagetitle', 'System');
    	\Base::instance()->set('subtitle', 'Diagnostics');
    	\Base::instance()->set('result', $result);
    	
    	$view = new \Dsc\Template;
    	echo $view->render('Admin/Views::system/diagnostics.php');
    }
}