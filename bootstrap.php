<?php 
$f3 = \Base::instance();
$global_app_name = $f3->get('APP_NAME');

switch ($global_app_name) 
{
    case "admin":
        // TODO register all the routes
        $f3->route('GET|POST /admin/logs', '\Admin\Controllers\Logs->display');
        $f3->route('GET|POST /admin/logs/@page', '\Admin\Controllers\Logs->display');
        $f3->route('GET|POST /admin/queue', '\Admin\Controllers\Queue->display');
        $f3->route('GET|POST /admin/queue/@page', '\Admin\Controllers\Queue->display');
        
        // TODO set some app-specific settings, if desired
        
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