<?php 
$f3 = \Base::instance();
$global_app_name = $f3->get('APP_NAME');

switch ($global_app_name) 
{
    case "admin":
        // TODO if the assets haven't ben copied to the public folder, do it
        
    	// register all the routes
    	\Dsc\System::instance()->get('router')->mount( new \Admin\Routes, 'admin' );
    	 
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