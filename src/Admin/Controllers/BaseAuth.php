<?php 
namespace Admin\Controllers;

class BaseAuth extends Base 
{
    public function beforeRoute()
    {
        $this->requireIdentity();
    }    
}
?>