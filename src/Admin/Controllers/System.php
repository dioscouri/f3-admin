<?php 
namespace Admin\Controllers;

class System extends BaseAuth 
{
    public function rebuildAdminMenu() 
    {
    	$settings = \Admin\Models\Settings::fetch();
        $root = new \Admin\Models\Nav\Primary;
        // delete all admin menu items, if there are any
        if(!empty( $settings->{'admin_menu_id'})){
        	\Admin\Models\Nav\Primary::collection()->remove(array( 'tree' => new \MongoId( (string)$settings->{'admin_menu_id'} ) ) );
        	// delete tree
        }
        
        $root->type = 'admin.nav';
        $root->{'is_root'} = true;
        $root->title = 'Admin Primary Navigation';
        $root->tree = new \MongoId();
        $root->save();
        $root->tree = $root->id;
        $root->save();
        
        $event = new \Joomla\Event\Event( 'onSystemRebuildMenu' );
        $event->addArgument('model', new \Admin\Models\Nav\Primary );
        $event->addArgument('root', $root->id );
        \Dsc\System::instance()->getDispatcher()->triggerEvent($event); 

        $navigation = new \Admin\Models\Nav\Primary;
        $navigation->insert(
        	array(
        		'type'	=> 'admin.nav',
        		'priority' => 110,
        		'title'	=> 'Navigation',
        		'icon'	=> 'fa fa-tasks',
				'is_root' => false,
        		'tree'	=> $root->id,	
        	)
        );
        
        $children = array(
        				array( 'title'=>'Menus', 'route'=>'/admin/menus', 'icon'=>'fa fa-list' ),
        				array( 'title'=>'Add New Menu', 'route'=>'/admin/menu', 'icon'=>'fa fa-plus', 'hidden'=>true ),
        				array( 'title'=>'Menu Items', 'route'=>'/admin/menus/items', 'icon'=>'fa fa-sitemap', 'hidden'=>true ),
        				array( 'title'=>'Add New Menu Item', 'route'=>'/admin/menus/item', 'icon'=>'fa fa-plus', 'hidden'=>true ),
        );
        $navigation->addChildrenItems( $children, $root->id );
        
        $system = new \Admin\Models\Nav\Primary;
        $system->insert(
        		array(
		        		'type'	=> 'admin.nav',
        				'priority' => 120,
        				'title'	=> 'System',
        				'icon'	=> 'fa fa-cogs',
						'is_root' => false,
        				'tree'	=> $root->id,
        			)
        );
        
        $children = array(
                array( 'title'=>'Settings', 'route'=>'/admin/settings', 'icon'=>'fa fa-cogs' ),
                array( 'title'=>'Rebuild Admin Menu', 'route'=>'/admin/system/rebuildAdminMenu', 'icon'=>'fa fa-retweet' ),
        		array( 'title'=>'Diagnostics', 'route'=>'/admin/system/diagnostics', 'icon'=>'fa fa-heart' ),
                array( 'title'=>'Logs', 'route'=>'/admin/logs', 'icon'=>'fa fa-list' ),
        	);
        $system->addChildrenItems( $children, $root->id );

        // save current admin menu id
        $settings->{'admin_menu_id'} = (string)$root->id;
        $settings->save();
        \Dsc\System::instance()->addMessage('Menu rebuilt', 'notice');
        
        \Base::instance()->set('pagetitle', 'System');
        \Base::instance()->set('subtitle', 'Rebuild Menu');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::home/default.php');
    }
    
    public function diagnostics()
    {
    	$event = new \Joomla\Event\Event( 'onSystemDiagnostics' );
    	$result = \Dsc\System::instance()->getDispatcher()->triggerEvent($event);

    	\Base::instance()->set('pagetitle', 'System');
    	\Base::instance()->set('subtitle', 'Diagnostics');
    	\Base::instance()->set('result', $result);
    	
    	echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::system/diagnostics.php');
    }
}