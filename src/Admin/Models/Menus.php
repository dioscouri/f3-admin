<?php 
namespace Admin\Models;

class Menus extends \Dsc\Models\Nested 
{
    protected $collection = 'navigation.items';
    protected $default_ordering_direction = '1';
    protected $default_ordering_field = 'lft';
    
    public function __construct($config=array())
    {
        parent::__construct($config);
    
        $this->filter_fields = $this->filter_fields + array(
                        'ordering', 'path'
        );
    }
    
    public function createRoot( $menus_mapper )
    {
        $mapper = $this->getMapper();
        $mapper->reset();
        $mapper->tree = (string) $menus_mapper->id;
        $mapper->title = $menus_mapper->title;
        $mapper->is_root = true;
        $mapper->lft = 1;
        $mapper->rgt = 2;
        $mapper->slug = $menus_mapper->slug;
        $mapper->path = "/" . $mapper->slug;
    
        return $mapper->save();
    }
    
    /**
     *
     * @return array
     */
    public function getParents()
    {
        $return = array();
        $return = $this->emptyState()->setState('filter.root', true)->getList();
    
        return $return;
    }
    
    protected function fetchFilters()
    {
        $this->filters = parent::fetchFilters();
    
        $filter_root = $this->getState('filter.root');
        if ($filter_root) {
            $this->filters['is_root'] = true;
        } elseif (is_bool($filter_root) && !$filter_root) {
            $this->filters['is_root'] = array( '$ne' => true );
        }
    
        $filter_tree = $this->getState('filter.tree');
        if (strlen($filter_tree)) {
            $this->filters['tree'] = (string) $filter_tree;
        }
    
        $filter_parent = $this->getState('filter.parent');
        if (strlen($filter_parent)) {
            $this->filters['parent'] = $filter_parent;
        }
    
        return $this->filters;
    }
    
    public function validate( $values, $options=array(), $mapper=null )
    {
        if (empty($values['title'])) {
            $this->setError('Title is required');
        }
    
        if (empty($values['tree']))
        {
            $this->setError('Items must be part of a tree');
        }
    
        if (empty($values['slug']))
        {
            $values['slug'] = \Joomla\Filter\OutputFilter::stringURLUnicodeSlug($values['title']);
        }
    
        if (!isset($values['parent']) || $values['parent'] == "null")
        {
            $values['parent'] = null;
        }
    
        if (empty($values['path']))
        {
            $values['path'] = $this->generatePath( $values );
        }
    
        if ($existing = $this->pathExists( $values['path']))
        {
            if (empty($mapper->_id) || $existing->_id != $mapper->_id)
            {
                $this->setError('An item with this title already exists with this parent.');
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
    
        // if no slug exists, generate it and make sure it's unique
        if (empty($values['slug']))
        {
            $values['slug'] = \Joomla\Filter\OutputFilter::stringURLUnicodeSlug($values['title']);
        }
    
        // if no parent is set, set it
        if (!isset($values['parent']) || $values['parent'] == "null")
        {
            $values['parent'] = null;
        }
    
        // if no path exists, set it
        if (empty($values['path']))
        {
            $values['path'] = $this->generatePath($values);
        }
    
        $options['skip_validation'] = true; // we've already done it above, so stop the parent from doing it
    
        return parent::save( $values, $options, $mapper );
    }
    
    public function generatePath( $values )
    {
        $path = null;
    
        $root = $this->getMapper()->getRoot( $values['tree'] );
    
        if (empty($values['parent'])) {
            if (!empty($values['is_root'])) {
                $path = "/" . $values['slug'];
            }
            elseif(!empty($root->slug)) {
                $path = "/" . $root->slug . "/" . $values['slug'];
            }
            
            return $path;
        }
    
        // get the parent's path, append the slug
        $model = self::instance()->emptyState()->setState('filter.id', $values['parent']);
        $mapper = $model->getItem();
        $model->emptyState();
    
        if (!empty($mapper->path)) {
            $path = $mapper->path;
        }
    
        $path .= "/" . $values['slug'];
    
        return $path;
    }
    
    public function pathExists( $path )
    {
        $mapper = $this->getMapper();
        $mapper->load(array('path'=>$path));
    
        if (!empty($mapper->_id)) {
            return $mapper;
        }
    
        return false;
    }
    
    /*
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
    */
}