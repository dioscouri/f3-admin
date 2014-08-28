<?php 
namespace Admin\Controllers\Cache;

class OpCache extends \Admin\Controllers\BaseAuth 
{
    public function index()
    {
        $this->app->set('meta.title', 'OpCache');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::cache/opcache.php');
    }
    
    public function reset()
    {
        try {
            opcache_reset();
        }
        catch (\Exception $e) {
            \Dsc\System::addMessage($e->getMessage(), 'error');
        }
        
        $this->app->reroute('/admin/cache/opcache');
    
    }
    
    public function invalidate()
    {
        try {
            $script = $this->input->get('script', '', 'raw');
            
            opcache_invalidate($script, true);
            
            \Dsc\System::addMessage('Invalidated ' . $script, 'success' );
        }
        catch (\Exception $e) {
            \Dsc\System::addMessage($e->getMessage(), 'error');
        }
                
        $this->app->reroute('/admin/cache/opcache');
    }
}