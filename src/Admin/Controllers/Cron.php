<?php 
namespace Admin\Controllers;

class Cron extends BaseAuth 
{
    public function index()
    {
        $crontab = new \Dsc\Cron\Crontab;
        $jobs = $crontab->getJobs();
        
        // TODO Filter against BASE PATH of site
        
        $this->app->set('jobs', $jobs);
        
        $this->app->set('meta.title', 'Cron');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::cron/index.php');
    }
    
    public function disable()
    {
        //$crontab->removeJobByHash('902feb1c055feef168761cd036bb74bb');
        //$crontab->write();        
    }
    
    public function delete()
    {
        $hash = $this->app->get('PARAMS.hash');
        
        $crontab = new \Dsc\Cron\Crontab;
        $jobs = $crontab->getJobs();

        try {
            $crontab->removeJobByHash($hash);
            $crontab->write();

            \Dsc\System::addMessage( 'Cron job removed', 'success' );
        }
        catch(\Exception $e) {
            \Dsc\System::addMessage( $e->getMessage(), 'error' );            
        }
        
        $this->app->reroute('/admin/cron');
    }
}