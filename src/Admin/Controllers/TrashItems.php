<?php 
namespace Admin\Controllers;

class TrashItems extends BaseAuth 
{
	use\Dsc\Traits\Controllers\AdminList;
	
	protected function getModel( $name = 'trash' )
	{
		$model = null;
		switch( $name ) {
			case 'trash' :
				$model = new \Dsc\Mongo\Collections\Trash;
				break;
		}
		return $model;
	}
	
    public function index()
    {
        $model = new \Dsc\Mongo\Collections\Trash;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $paginated = $model->paginate();
        \Base::instance()->set('paginated', $paginated);
        
        $this->app->set('meta.title', 'Trash Items');
        
        echo \Dsc\System::instance()->get('theme')->renderTheme('Admin/Views::trash/list.php');
    }
}