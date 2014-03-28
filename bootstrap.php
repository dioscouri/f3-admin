<?php 

class AdminBootstrap extends \Dsc\Bootstrap{
	protected $dir = __DIR__;
	protected $namespace = 'Admin';

	protected function runAdmin(){

		$f3 = \Base::instance();
		//link the theme to public folder
		if(!is_dir($f3->get('PATH_ROOT').'public/AdminTheme')) {
			$publictheme = $f3->get('PATH_ROOT').'public/AdminTheme';
			$admintheme = $f3->get('PATH_ROOT').'vendor/dioscouri/f3-admin/AdminTheme';
			exec('ln -s '. $admintheme . ' '. $publictheme);
		}
		
		\Dsc\System::instance()->get('theme')->setTheme('AdminTheme',$this->dir . '/src/Admin/Theme/' );
		// append this app's template folder to the path
		$templates = $f3->get('TEMPLATES');
		$templates .= ";" . $this->dir . "/src/Admin/Templates/";
		$f3->set('TEMPLATES', $templates);
		parent::runAdmin();
	}
}
$app = new AdminBootstrap();