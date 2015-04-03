<?php
namespace Admin\Controllers;

class System extends BaseAuth
{

    public function rebuildAdminMenu()
    {
        $this->rebuilAdminMenuCode();
        
        if ($custom_redirect = $this->session->get( 'rebuild-menu.redirect' )) 
        {
        	return $this->app->reroute( $custom_redirect );        	
        }
        
        $this->app->set('meta.title', 'Rebuild Menu');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::message.php');
    }

    public function rebuilAdminMenuCode()
    {
        $settings = \Admin\Models\Settings::fetch();
        $root = new \Admin\Models\Nav\Primary();
        
        // delete all admin menu items, if there are any
        \Admin\Models\Nav\Primary::collection()->remove(array(
            'type' => 'admin.nav'
        ));
        
        $root->type = 'admin.nav';
        $root->{'is_root'} = true;
        $root->title = 'Admin Primary Navigation';
        $root->tree = new \MongoId();
        $root->save();
        $root->tree = $root->id;
        $root->save();
        
        // save current admin menu id
        $settings->{'admin_menu_id'} = (string) $root->id;
        $settings->save();        
        
        /**
         * Languages Menu Items
         */
        $parent = new \Admin\Models\Nav\Primary();
        $parent->insert(array(
            'type' => 'admin.nav',
            'priority' => 90,
            'title' => 'Translations',
            'icon' => 'fa fa-language',
            'is_root' => false,
            'tree' => $root->id,
            'base' => '/admin/language'
        ));
        
        $children = array(
            array(
                'title' => 'Languages',
                'route' => './admin/languages',
                'icon' => 'fa fa-list'
            )
        );
        $parent->addChildren($children, $root);
        
        \Dsc\System::addMessage('Translations added its admin menu items.');
        
        /**
         * System Nav
         */
        $navigation = new \Admin\Models\Nav\Primary();
        $navigation->insert(array(
            'type' => 'admin.nav',
            'priority' => 100,
            'title' => 'Navigation',
            'icon' => 'fa fa-tasks',
            'is_root' => false,
            'tree' => $root->id
        ));
        
        $children = array(
            array(
                'title' => 'Menus',
                'route' => './admin/menus',
                'icon' => 'fa fa-list'
            ),
        );
        
        $navigation->addChildren($children);
        
        $system = new \Admin\Models\Nav\Primary();
        $system->insert(array(
            'type' => 'admin.nav',
            'priority' => 1000,
            'title' => 'System',
            'icon' => 'fa fa-cogs',
            'is_root' => false,
            'tree' => $root->id
        ));
        
        $children = array(
            array(
                'title' => 'Settings',
                'route' => './admin/settings',
                'icon' => 'fa fa-cogs'
            ),
            array(
                'title' => 'Rebuild Menu',
                'route' => './admin/system/rebuildAdminMenu',
                'icon' => 'fa fa-retweet'
            ),
            array(
                'title' => 'Queue',
                'route' => 'javascript:void(0);',
                'icon' => 'fa fa-refresh'
            ),
            array(
                'title' => 'Cron',
                'route' => './admin/cron',
                'icon' => 'fa fa-clock-o'
            ),            
            array(
                'title' => 'Logs',
                'route' => './admin/logs',
                'icon' => 'fa fa-list'
            ),
            array(
                'title' => 'Cache',
                'route' => 'javascript:void(0);',
                'icon' => 'fa fa-star'
            ),                        
            array(
                'title' => 'Diagnostics',
                'route' => './admin/system/diagnostics',
                'icon' => 'fa fa-heart'
            ),
        	array(
				'title' => 'Trash',
				'route' => './admin/trash/items',
				'icon' => 'fa fa-trash'
    		),
        );
        $system->addChildren($children);
        
        // Find the Queue Item
        $queue_item = (new \Admin\Models\Nav\Primary())->load(array(
            'type' => 'admin.nav',
            'parent' => $system->id,
            'title' => 'Queue'
        ));
        
        // add its children
        if (!empty($queue_item->id))
        {
            $system_children = array(
                array(
                    'title' => 'Tasks',
                    'route' => './admin/queue/tasks',
                    'icon' => 'fa fa-link'
                ),
                array(
                    'title' => 'Archive',
                    'route' => './admin/queue/archives',
                    'icon' => 'fa fa-gift'
                )
            );
        
            $queue_item->addChildren($system_children);
        }

        // Find the Cache Item
        $cache_item = (new \Admin\Models\Nav\Primary())->load(array(
            'type' => 'admin.nav',
            'parent' => $system->id,
            'title' => 'Cache'
        ));
        
        // add its children
        if (!empty($cache_item->id))
        {
            $system_children = array(
                array(
                    'title' => 'OpCache',
                    'route' => './admin/cache/opcache',
                    'icon' => 'fa fa-forward'
                ),
                array(
                    'title' => 'APCu',
                    'route' => './admin/cache/apcu',
                    'icon' => 'fa fa-eraser'
                )
            );
        
            $cache_item->addChildren($system_children);
        }        
        
        \Dsc\System::instance()->addMessage('System added its admin menu items');

        $result = \Dsc\System::instance()->trigger('onSystemRebuildMenu', array(
            'model' => new \Admin\Models\Nav\Primary,
            'root' => $root->id
        ));

        \Dsc\System::instance()->addMessage('Menu rebuilt', 'notice');
    }

    public function diagnostics()
    {
        $result = \Dsc\System::instance()->trigger('onSystemDiagnostics');
        
        \Base::instance()->set('result', $result);
        
        $this->app->set('meta.title', 'Diagnostics');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::system/diagnostics.php');
    }
}