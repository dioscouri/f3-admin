<?php 
namespace Admin\Models;

class Settings extends \Dsc\Mongo\Collections\Settings
{
	protected $__type = 'common.settings';
	
	public $sro_ssl = '0';
	public $admin_menu_id = null;
}