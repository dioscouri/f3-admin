<?php
namespace Admin\Models;

class Settings extends \Dsc\Mongo\Collections\Settings
{

    protected $__type = 'admin.settings';

    public $admin_menu_id = null;

    public $system = array(
        'force_ssl' => 0,
        'page_title_suffix' => null
    );

    public $integration = array(
        'kissmetrics' => array(
            'enabled' => 0,
            'key' => ''
        )
    );

    public function enabledIntegration($name)
    {
        $result = false;
        
        switch ($name)
        {
            case 'kissmetrics':
                $result = $this->{'integration.kissmetrics.enabled'} && strlen($this->{'integration.kissmetrics.key'});
                break;
        }
        
        return $result;
    }
}