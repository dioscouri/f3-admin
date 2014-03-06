<?php 

class AdminBootstrap extends \Dsc\BaseBootstrap{
	protected $dir = __DIR__;
	protected $namespace = 'Admin';

	protected function runAdmin(){
		$f3 = \Base::instance();
		\Dsc\System::instance()->get('theme')->setTheme('AdminTheme',$this->dir . '/src/Admin/Theme/' );
		// append this app's template folder to the path
		$templates = $f3->get('TEMPLATES');
		$templates .= ";" . $this->dir . "/src/Admin/Templates/";
		$f3->set('TEMPLATES', $templates);
		parent::runAdmin();
	}
}
$app = new AdminBootstrap();