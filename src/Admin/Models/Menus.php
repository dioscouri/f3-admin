<?php 
namespace Admin\Models;

class Menus extends \Dsc\Models\Db\Mongo 
{
    protected $collection = 'navigation.menus';
    protected $default_ordering_direction = '1';
    protected $default_ordering_field = 'title';

    protected function fetchFilters()
    {
        $this->filters = array();
    
        $filter_keyword = $this->getState('filter.keyword');
        if ($filter_keyword && is_string($filter_keyword))
        {
            $key =  new \MongoRegex('/'. $filter_keyword .'/i');
    
            $where = array();
            $where[] = array('title'=>$key);
            $where[] = array('description'=>$key);
            $where[] = array('slug'=>$key);
            $where[] = array('path'=>$key);
    
            $this->filters['$or'] = $where;
        }
    
        $filter_id = $this->getState('filter.id');
        if (strlen($filter_id))
        {
            $this->filters['_id'] = new \MongoId((string) $filter_id);
        }
    
        return $this->filters;
    }
    
    public function validate( $values, $options=array(), $mapper=null )
    {
        if (empty($values['title'])) {
            $this->setError('Title is required');
        }
        
        if (empty($values['slug']))
        {
            $values['slug'] = \Joomla\Filter\OutputFilter::stringURLUnicodeSlug($values['title']);
        }
    
        if ($existing = $this->slugExists( $values['slug']))
        {
            if (empty($mapper->_id) || $existing->_id != $mapper->_id)
            {
                $this->setError('An item with this title already exists.');
            }
        }
    
        return parent::validate( $values, $options );
    }
    
    public function save( $values, $options=array(), $mapper=null )
    {
        if (empty($options['skip_validation'])) 
        {
            $this->validate( $values, $options, $mapper );
        }
        
        if (empty($values['slug']))
        {
            $values['slug'] = \Joomla\Filter\OutputFilter::stringURLUnicodeSlug($values['title']);
        }
        
        $options['skip_validation'] = true; // we've already done it above, so stop the parent from doing it
        
        return parent::save( $values, $options, $mapper );
    }
    
    public function create( $values, $options=array() )
    {
        if ($return = parent::create( $values, $options )) 
        {
            // TODO create the root node in the navigation.items table
            $itemsModel = $this->getItemsModel()->createRoot( $return );
        }
        
        return $return;
    }
    
    public function slugExists( $slug )
    {
        $mapper = $this->getMapper();
        $mapper->load(array('slug'=>$slug));
    
        if (!empty($mapper->_id)) {
            return $mapper;
        }
    
        return false;
    }
    
    public function getItemsModel() 
    {
        $model = new \Admin\Models\MenuItems;
        return $model;
    }
    
    public function delete( $mapper, $options=array() )
    {
        $tree = (string) $mapper->id;
        
        if ($return = parent::delete($mapper, $options)) 
        {
            // delete all menu items in this tree
            $collection = $this->getItemsModel()->getCollection();
            $collection->remove(array('tree' => $tree));
        }
    }
}