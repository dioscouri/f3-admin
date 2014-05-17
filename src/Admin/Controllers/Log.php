<?php 
namespace Admin\Controllers;

class Log extends \Admin\Controllers\BaseAuth
{
    public function edit()
    {
        $f3 = \Base::instance();
        $id = $this->inputfilter->clean( $f3->get('PARAMS.id'), 'alnum' );
        $record = (new \Dsc\Mongo\Collections\Logs)->load(array('_id' => new \MongoId( $id ) ));
        \Base::instance()->set('item', $record );
        
        $this->app->set('meta.title', 'Log');
        
        $view = \Dsc\System::instance()->get('theme');
        echo $view->render('Admin/Views::logs/view.php');        
    }
}
?>