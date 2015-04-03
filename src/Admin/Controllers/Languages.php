<?php 
namespace Admin\Controllers;

class Languages extends \Admin\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\AdminList;
    use \Dsc\Traits\Controllers\SupportPreview;
    use \Dsc\Traits\Controllers\OrderableItemCollection,
        \Dsc\Traits\Controllers\EnablableItem;
        
    protected $list_route = '/admin/languages';

    protected function getModel()
    {
        $model = new \Dsc\Mongo\Collections\Translations\Languages;
        return $model; 
    }
	
	public function index()
    {
        // when ACL is ready
        //$this->checkAccess( __CLASS__, __FUNCTION__ );
        
        $model = $this->getModel();
        $state = $model->populateState()->getState();
        $this->app->set('state', $state );
        
        $paginated = $model->paginate();
        $this->app->set('paginated', $paginated );
        
        $this->app->set('meta.title', 'Languages');
        
        $view = \Dsc\System::instance()->get('theme');
        echo $view->render('Admin/Views::languages/index.php');
    }
}