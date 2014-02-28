<?php 
namespace Admin\Controllers;

class BaseAuth extends Base 
{
    public function beforeRoute($f3)
    {
        $identity = $this->getIdentity();
        if (empty($identity->id))
        {
            $f3->reroute('/admin/login');
        }
    }    
}
?>