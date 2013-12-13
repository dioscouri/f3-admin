<?php 
namespace Admin\Controllers;

class System extends BaseAuth 
{
    public function rebuildMenu() 
    {
        $model = new \Admin\Models\Nav\Primary;
        $mapper = $model->getMapper();
        
        $model->drop(); // delete the menu
        
        $event = new \Joomla\Event\Event( 'onSystemRebuildMenu' );
        $event->addArgument('model', $model);
        $event->addArgument('mapper', $mapper);
        \Dsc\System::instance()->getDispatcher()->triggerEvent($event); 
        
        $mapper->reset();
        $mapper->title = 'Users';
        $mapper->route = '';
        $mapper->icon = 'fa fa-user';
        $mapper->children = array(
                json_decode(json_encode(array( 'title'=>'List', 'route'=>'/admin/users', 'icon'=>'fa fa-list' )))
                ,json_decode(json_encode(array( 'title'=>'Detail', 'route'=>'/admin/user', 'hidden'=>true )))
        );
        $mapper->save();

        $mapper->reset();
        $mapper->title = 'System';
        $mapper->route = '';
        $mapper->icon = 'fa fa-cogs';
        $mapper->children = array(
                json_decode(json_encode(array( 'title'=>'Settings', 'route'=>'/admin/settings', 'icon'=>'fa fa-cogs' )))
                ,json_decode(json_encode(array( 'title'=>'Rebuild Menu', 'route'=>'/admin/system/rebuildMenu', 'icon'=>'fa fa-retweet' )))
                ,json_decode(json_encode(array( 'title'=>'Logs', 'route'=>'/admin/logs', 'icon'=>'fa fa-list' )))
                ,json_decode(json_encode(array( 'title'=>'Log Detail', 'route'=>'/admin/log', 'hidden'=>true )))
        );
        $mapper->save();
        
        \Dsc\System::instance()->addMessage('Menu rebuilt', 'notice');
        
        \Base::instance()->set('pagetitle', 'Testing');
        \Base::instance()->set('subtitle', 'Repopulate Menu');
        
        $view = new \Dsc\Template;
        echo $view->render('home/default.php');
    }
}