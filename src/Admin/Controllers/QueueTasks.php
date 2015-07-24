<?php 
namespace Admin\Controllers;

class QueueTasks extends BaseAuth 
{
    public function index()
    {
        $model = new \Dsc\Mongo\Collections\QueueTasks;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $paginated = $model->paginate();
        \Base::instance()->set('paginated', $paginated);
        
        $this->app->set('meta.title', 'Queue Tasks');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::queuetasks/list.php');
    }
    
    
    public function processes()
    {
    	$model = new \Dsc\Mongo\Collections\QueueTasks;
    	$state = $model->populateState()->getState();
    	\Base::instance()->set('state', $state );
    	    
    	$ps = explode("\n", trim(shell_exec('ps axo pid,ppid,%cpu,pmem,user,group,args --sort %cpu | grep php')));
    	foreach($ps AS $process){
    		$processes[]=preg_split('@\s+@', trim($process), 7 );
    	}
    	
    	$head= array_shift($processes);
    	$processes = array_reverse($processes);
   
    	
    	\Base::instance()->set('head', $head);
    	\Base::instance()->set('items', $processes);
    
    	$this->app->set('meta.title', 'Queue Tasks');
    
    	echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::queuetasks/processes.php');
    }
}