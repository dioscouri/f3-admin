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
    
    public function enable()
    {
        $hash = $this->app->get('PARAMS.hash');
    
        $crontab = new \Dsc\Cron\Crontab;
        $jobs = $crontab->getJobs();
    
        try {
            $crontab->enableJobByHash($hash);
            $crontab->write();
    
            \Dsc\System::addMessage( 'Cron job enabled', 'success' );
        }
        catch(\Exception $e) {
            \Dsc\System::addMessage( $e->getMessage(), 'error' );
        }
    
        $this->app->reroute('/admin/cron');
    }    
    
    public function disable()
    {
        $hash = $this->app->get('PARAMS.hash');
        
        $crontab = new \Dsc\Cron\Crontab;
        $jobs = $crontab->getJobs();
        
        try {
            $crontab->disableJobByHash($hash);
            $crontab->write();
        
            \Dsc\System::addMessage( 'Cron job disabled', 'success' );
        }
        catch(\Exception $e) {
            \Dsc\System::addMessage( $e->getMessage(), 'error' );
        }
        
        $this->app->reroute('/admin/cron');
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
    
    public function create()
    {
        $this->app->set('meta.title', 'Create | Cron');
        
        $flash = \Dsc\Flash::instance();
        $this->app->set('flash', $flash);
    
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::cron/create.php');
    }
    
    public function edit()
    {
        $flash = \Dsc\Flash::instance();
        $this->app->set('flash', $flash);
                
        $hash = $this->app->get('PARAMS.hash');
        $crontab = new \Dsc\Cron\Crontab;
        
        try 
        {
            $job = $crontab->getJobByHash($hash);
            $flash->store($job->cast());
            //\Dsc\System::addMessage( \Dsc\Debug::dump($job->cast()) );
        }
        catch (\Exception $e) 
        {
            \Dsc\System::addMessage( $e->getMessage(), 'error' );
            $this->app->reroute('/admin/cron');
            return;
        }
    
        $this->app->set('meta.title', 'Edit | Cron');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::cron/edit.php');
    }
    
    public function save()
    {
        try {
            $request = $this->app->get('REQUEST');
            
            $job = new \Dsc\Cron\Job();
            $job
            ->setMinute($request['minute'])
            ->setHour($request['hour'])
            ->setDayOfMonth($request['dayOfMonth'])
            ->setMonth($request['month'])
            ->setDayOfWeek($request['dayOfWeek'])
            ->setCommand($request['command'])
            ->setActive($request['active'])
            ;

            //\Dsc\System::addMessage( \Dsc\Debug::dump($job->cast()) );
            
            $crontab = new \Dsc\Cron\Crontab;
            $crontab->addJob($job);
            $crontab->write();
    
            \Dsc\System::addMessage( 'Cron job added', 'success' );
        }
        catch(\Exception $e) {
            \Dsc\System::addMessage( $e->getMessage(), 'error' );
        }
    
        $this->app->reroute('/admin/cron');
    }
}