<?php
namespace Admin;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class Routes extends \Dsc\Routes\Group
{

    /**
     * Initializes all routes for this group
     * NOTE: This method should be overriden by every group
     */
    public function initialize()
    {
        $this->setDefaults( array(
            'namespace' => '\Admin\Controllers',
            'url_prefix' => '/admin' 
        ) );
        
        $this->add( '', 'GET', array(
            'controller' => 'Home',
            'action' => 'display' 
        ) );
        
        $this->add( '/login', 'GET', array(
            'controller' => 'Login',
            'action' => 'login' 
        ) );
        
        $this->add( '/login', 'POST', array(
            'controller' => 'Login',
            'action' => 'auth' 
        ) );
        
        $this->add( '/logout', 'GET', array(
            'controller' => 'Login',
            'action' => 'logout' 
        ) );
        
        $this->add( '/system/@task', 'GET', array(
            'controller' => 'System',
            'action' => '@task' 
        ) );
        
        $this->addSettingsRoutes();
        $this->addCrudList( 'Logs' );
        $this->addCrudList( 'Queue' );
        $this->addCrudList( 'Menus' );
        
        $this->add( '/menus/all', 'GET', array(
            'controller' => 'Menus',
            'action' => 'getAll',
            'ajax' => true 
        ) );
        
        $this->add( '/menus/@id', array(
            'GET',
            'POST' 
        ), array(
            'controller' => 'Menus',
            'action' => 'index' 
        ) );
        
        $this->add( '/menus/@id/page/@page', array(
            'GET',
            'POST' 
        ), array(
            'controller' => 'Menus',
            'action' => 'index' 
        ) );
        
        $this->addCrudItem( 'Menu' );
        $this->add( '/menu/moveup/@id', 'GET', array(
            'controller' => 'Menu',
            'action' => 'moveUp' 
        ) );
        
        $this->add( '/menu/movedown/@id', 'GET', array(
            'controller' => 'Menu',
            'action' => 'moveDown' 
        ) );
    }
}