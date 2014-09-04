<?php 
namespace Admin\Controllers;

class BaseAuth extends Base 
{
    public function beforeRoute()
    {
    	parent::beforeRoute();
    	//TODO remove this hack, after ACL is finished
    	$user = $this->auth->getIdentity();
    	if($user->role != 'root') {
    		$this->auth->logout();
    		\Dsc\System::addMessage('Not Authorized');
    		$this->app->reroute('/admin/login');
    	}
    	
        $this->requireIdentity();
    }    
}
?>
