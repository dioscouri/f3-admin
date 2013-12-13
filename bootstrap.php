<?php 
$f3 = \Base::instance();
$global_app_name = $f3->get('APP_NAME');

switch ($global_app_name) 
{
    case "admin":
        // TODO register all the routes
        // TODO set some app-specific settings, if desired
        break;
}
?>