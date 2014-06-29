<?php
class AdminBootstrap extends \Dsc\Bootstrap
{

    protected $dir = __DIR__;

    protected $namespace = 'Admin';

    protected function runAdmin()
    {
        $f3 = \Base::instance();

        if (!is_dir($f3->get('PATH_ROOT') . 'public/AdminTheme'))
        {
            $publictheme = $f3->get('PATH_ROOT') . 'public/AdminTheme';
            $admintheme = $f3->get('PATH_ROOT') . 'vendor/dioscouri/f3-admin/AdminTheme';
            $res = symlink($admintheme, $publictheme);
        }
        
        \Dsc\System::instance()->get('theme')->setTheme('AdminTheme', $this->dir . '/src/Admin/Theme/');

        if (class_exists('\Modules\Factory')) 
        {
            \Modules\Factory::registerPositions( array( 'admin-dashboard') );
        }
        
        if (class_exists('\Search\Factory'))
        {
            \Search\Factory::registerSource(new \Search\Models\Source(array(
                'id' => 'navigation',
                'title' => 'Navigation Items',
                'class' => '\Admin\Models\Navigation'
            )));
        }        
        
        parent::runAdmin();
    }
}
$app = new AdminBootstrap();