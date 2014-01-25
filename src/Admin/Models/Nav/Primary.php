<?php 
namespace Admin\Models\Nav;

class Primary extends \Admin\Models\Nav 
{
    protected $filename = "admin.nav.primary";
    
    protected $default_ordering_direction = 'SORT_ASC';
    protected $default_ordering_field = 'priority';
    
    public function __construct($config=array())
    {
        parent::__construct($config);
    
        $this->filter_fields = $this->filter_fields + array(
                        'priority'
        );
    }
    
    public function getMapper()
    {
        $mapper = new \Admin\Mappers\Nav( $this->getDb(), $this->filename );
        return $mapper;
    }
}
?>