<?php 
namespace Admin\Controllers;

class Base extends \Dsc\Controller 
{    
    public function beforeRoute()
    {
    	// check, if we have admin menu
    	$id = \Admin\Models\Settings::fetch()->get('admin_menu_id');
    	if( empty( $id ) ) { // no admin menu => generate new
    		\Dsc\Request::internal('Admin\Controllers\System->rebuildAdminMenuCode');
    	}
    }    
}
?>
