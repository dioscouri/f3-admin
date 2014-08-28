<?php 
namespace Admin\Controllers\Cache;

class Apcu extends \Admin\Controllers\BaseAuth 
{
    public function index()
    {
        $this->app->set('meta.title', 'Apcu');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::cache/apcu.php');
    }
    
    public function reset()
    {
        try {
            apcu_clear_cache();
        }
        catch (\Exception $e) {
            \Dsc\System::addMessage($e->getMessage(), 'error');
        }
        
        $this->app->reroute('/admin/cache/apcu');
    
    }
    
    public function invalidate()
    {
        try {
            $key = $this->input->get('key', '', 'raw');
            
            if (empty($key) || !apcu_exists($key)) {
                throw new \Exception( 'Invalid Key: ' . $key );
            }
                        
            apcu_delete($key);
            
            \Dsc\System::addMessage('Invalidated ' . $key, 'success' );
        }
        catch (\Exception $e) {
            \Dsc\System::addMessage($e->getMessage(), 'error');
        }
                
        $this->app->reroute('/admin/cache/apcu');
    }
    
    public function read()
    {
        try {
            $key = $this->input->get('key', '', 'raw');
        
            if (empty($key) || !apcu_exists($key)) {
                throw new \Exception( 'Invalid Key: ' . $key );
            }
            
            $data = apcu_fetch($key, $success);
            if (!$success) {
                \Dsc\System::addMessage('Fetching data unsuccessful', 'error');
            }
            $this->app->set('key', $key );
            $this->app->set('data', $data );
        
            echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::cache/apcu_read.php');
            
        }
        catch (\Exception $e) {
            \Dsc\System::addMessage($e->getMessage(), 'error');
            $this->app->reroute('/admin/cache/apcu');
        }
    }
}