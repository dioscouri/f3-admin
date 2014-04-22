<?php 
namespace Admin\Controllers;

class BaseAuth extends Base 
{
    public function beforeRoute($f3)
    {
        $identity = $this->getIdentity();
        if (empty($identity->id))
        {
            $path = $this->inputfilter->clean( $f3->hive()['PATH'], 'string' );
            \Dsc\System::instance()->get( 'session' )->set( 'admin.login.redirect', $path );

            $f3->reroute('/admin/login');
        }
    }    
}
?>