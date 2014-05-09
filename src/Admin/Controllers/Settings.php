<?php 
namespace Admin\Controllers;

class Settings extends BaseAuth
{
	use \Dsc\Traits\Controllers\Settings;	
	
	protected $layout_link = 'Admin/Views::settings/default.php';
	protected $settings_route = '/admin/settings';
    
    protected function getModel()
    {
        $model = new \Admin\Models\Settings;
        return $model;
    }
}