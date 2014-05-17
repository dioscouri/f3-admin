<?php 
namespace Admin\Models;

class Settings extends \Dsc\Mongo\Collections\Settings
{
	protected $__type = 'admin.settings';

	public $admin_menu_id = null;
	
	public $system = array(
		'force_ssl' => 0
	);
}