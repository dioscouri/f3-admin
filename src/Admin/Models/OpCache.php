<?php 
namespace Admin\Models;

class OpCache extends \Dsc\Models
{
    public function config()
    {
        $config = opcache_get_configuration();
    
        return $config;
    }
        
    public function status()
    {
        $status = opcache_get_status();
        
        return $status;
    } 
}