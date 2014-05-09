<?php
namespace Admin\Mappers;

class Nav extends \Dsc\Jig\Mapper 
{
    public function check()
    {
        if (!$this->{'priority'}) {
            $this->set('priority', 30);
        }
        
        return true;
    }
    
    /**
     *	Save mapped record
     *	@return mixed
     **/
    public function save() {
        if (!$this->check()) {
            // TODO Throw an error?  What?
        }
        return $this->query?$this->update():$this->insert();
    }
}