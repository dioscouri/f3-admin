<?php 
namespace Admin\Controllers;

class BaseAuth extends Base 
{
    public function beforeRoute()
    {
    	parent::beforeRoute();
    	//TODO remove this hack, after ACL is finished
    	$role = $this->auth->getIdentity()->getRole();
    	 //TODO maybe the Role gets stored in the session to avoid one more DB query every load, or maybe none of this makes it to the future
    	if($role->slug == 'root') {
    		//root always has access no farther checks needed
    	} elseif(!$role->adminaccess){
    		//if this role is not admin and not given admin permissions
    		$this->auth->logout();
    		\Dsc\System::addMessage('Not Authorized');
    		$this->app->reroute('/admin/login');
    	}
    	
        $this->requireIdentity();
    }    
}
?>
