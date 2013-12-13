<?php 
namespace Admin\Models;

class Base extends \Dsc\Model 
{
    protected $db = null; // the db connection object
    
    public function getDb()
    {
        if (empty($this->db))
        {
            $db_name = \Base::instance()->get('db.mongo.name');
            $this->db = new \DB\Mongo('mongodb://localhost:27017', $db_name);
        }
    
        return $this->db;
    }
}
?>