<?php 
$f3 = \Base::instance();
$global_app_name = $f3->get('APP_NAME');

switch ($global_app_name) 
{
    case "admin":
        // TODO if the assets haven't ben copied to the public folder, do it
        
        // register all the routes
    	$f3->route('GET /admin', '\Admin\Controllers\Home->display');
    	$f3->route('GET /admin/login', '\Admin\Controllers\Login->login');
    	$f3->route('POST /admin/login', '\Admin\Controllers\Login->auth');
    	$f3->route('GET /admin/logout', '\Admin\Controllers\Login->logout');
    	$f3->route('GET /admin/system/@task', '\Admin\Controllers\System->@task');
    	$f3->route('GET /admin/settings', '\Admin\Controllers\Settings->display');
    	$f3->route('POST /admin/settings', '\Admin\Controllers\Settings->save');
        $f3->route('GET|POST /admin/logs', '\Admin\Controllers\Logs->display');
        $f3->route('GET|POST /admin/logs/@page', '\Admin\Controllers\Logs->display');
        $f3->route('GET|POST /admin/queue', '\Admin\Controllers\Queue->display');
        $f3->route('GET|POST /admin/queue/@page', '\Admin\Controllers\Queue->display');

        $f3->route('GET /admin/menus/all [ajax]','\Admin\Controllers\Menus->getAll');
        $f3->route('GET|POST /admin/menus', '\Admin\Controllers\Menus->display');
        $f3->route('GET|POST /admin/menus/@id', '\Admin\Controllers\Menus->display');
        $f3->route('GET|POST /admin/menus/@id/page/@page', '\Admin\Controllers\Menus->display');
        
        $f3->route('GET /admin/menu', '\Admin\Controllers\Menu->create');
        $f3->route('POST /admin/menu', '\Admin\Controllers\Menu->add');
        $f3->route('GET /admin/menu/@id', '\Admin\Controllers\Menu->read');
        $f3->route('GET /admin/menu/@id/edit', '\Admin\Controllers\Menu->edit');
        $f3->route('POST /admin/menu/@id', '\Admin\Controllers\Menu->update');
        $f3->route('DELETE /admin/menu/@id', '\Admin\Controllers\Menu->delete');
        $f3->route('GET /admin/menu/@id/delete', '\Admin\Controllers\Menu->delete');
        $f3->route('GET /admin/menu/@id/moveup', '\Admin\Controllers\Menu->moveUp');
        $f3->route('GET /admin/menu/@id/movedown', '\Admin\Controllers\Menu->moveDown');
        
        // new way
        \Dsc\System::instance()->get('theme')->setTheme('AdminTheme', $f3->get('PATH_ROOT') . 'vendor/dioscouri/f3-admin/src/Admin/Theme/' );
        \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT') . 'vendor/dioscouri/f3-admin/src/Admin/Views/', 'Admin/Views' );
        
        // append this app's UI folder to the path
        $ui = $f3->get('UI');
        $ui .= ";" . $f3->get('PATH_ROOT') . "vendor/dioscouri/f3-admin/src/Admin/Views/";
        $f3->set('UI', $ui);
        
        // append this app's template folder to the path
        $templates = $f3->get('TEMPLATES');
        $templates .= ";" . $f3->get('PATH_ROOT') . "vendor/dioscouri/f3-admin/src/Admin/Templates/";
        $f3->set('TEMPLATES', $templates);
        
        
        break;
}
?>