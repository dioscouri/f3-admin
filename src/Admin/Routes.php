<?php

namespace Admin;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class Routes extends \Dsc\Routes\Group{
	
	
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * Initializes all routes for this group
	 * NOTE: This method should be overriden by every group
	 */
	public function initialize(){
		$this->setDefaults(
				array(
					'namespace' => '\Admin\Controllers',
					'url_prefix' => '/admin'
				)
		);
		
		$this->add( '', 'GET', array(
								'controller' => 'Home',
								'action' => 'display'
								));

		$this->add( '/login', 'GET', array(
				'controller' => 'Login',
				'action' => 'login'
		));

		$this->add( '/login', 'POST', array(
				'controller' => 'Login',
				'action' => 'auth'
		));

		$this->add( '/logout', 'GET', array(
				'controller' => 'Login',
				'action' => 'logout'
		));

		$this->add( '/system/@task', 'GET', array(
				'controller' => 'System',
				'action' => '@task'
		));

		$this->add( '/settings', 'GET', array(
				'controller' => 'Settings',
				'action' => 'display'
		));

		$this->add( '/settings', 'POST', array(
				'controller' => 'Settings',
				'action' => 'save'
		));

		$this->add( '/logs', array('GET', 'POST'), array(
				'controller' => 'Logs',
				'action' => 'display'
		));

		$this->add( '/logs/@page', array('GET', 'POST'), array(
				'controller' => 'Logs',
				'action' => 'display'
		));

		$this->add( '/queue', array('GET', 'POST'), array(
				'controller' => 'Queue',
				'action' => 'display'
		));

		$this->add( '/queue/@page', array('GET', 'POST'), array(
				'controller' => 'Queue',
				'action' => 'display'
		));

		$this->add( '/menus/all', 'GET', array(
				'controller' => 'Menus',
				'action' => 'getAll',
				'ajax' => true
		));

		$this->add( '/menus', array('GET', 'POST'), array(
				'controller' => 'Menus',
				'action' => 'display'
		));

		$this->add( '/menus/@id', array('GET', 'POST'), array(
				'controller' => 'Menus',
				'action' => 'display'
		));

		$this->add( '/menus/@id/page/@page', array('GET', 'POST'), array(
				'controller' => 'Menus',
				'action' => 'display'
		));

		$this->add( '/menu', 'GET', array(
				'controller' => 'Menu',
				'action' => 'create'
		));
		
		$this->add( '/menu', 'POST', array(
				'controller' => 'Menu',
				'action' => 'add'
		));

		$this->add( '/menu/@id', 'GET', array(
				'controller' => 'Menu',
				'action' => 'read'
		));

		$this->add( '/menu/@id/edit', 'GET', array(
				'controller' => 'Menu',
				'action' => 'edit'
		));
		
		$this->add( '/menu/@id', 'POST', array(
				'controller' => 'Menu',
				'action' => 'update'
		));

		$this->add( '/menu/@id', 'DELETE', array(
				'controller' => 'Menu',
				'action' => 'delete'
		));

		$this->add( '/menu/@id/delete', 'GET', array(
				'controller' => 'Menu',
				'action' => 'delete'
		));

		$this->add( '/menu/@id/moveup', 'GET', array(
				'controller' => 'Menu',
				'action' => 'moveUp'
		));

		$this->add( '/menu/@id/movedown', 'GET', array(
				'controller' => 'Menu',
				'action' => 'moveDown'
		));
	}
}