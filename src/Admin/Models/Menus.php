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
    
    /**
     *
     * @return array
     */
    public function getRoots()
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
        
        // if published is not set, set it
        if (!isset($values['published'])) {
            $values['published'] = false;
        } else {
            $values['published'] = (bool) $values['published'];
        }
    
        $options['skip_validation'] = true; // we've already done it above, so stop the parent from doing it
    
        return parent::save( $values, $options, $mapper );
    }
    
    public function update( $mapper, $values, $options=array() )
    {
    	$update_children = isset($options['update_children']) ? $options['update_children'] : false;
    	
    	if (empty($values['parent']) || $values['parent'] == 'null') {
    		$values['is_root'] = true;
    	} else {
    		$values['is_root'] = false;
    	}

    	// rebuild the path
    	$values['path'] = $this->generatePath($values);
    	
        // if the mapper's parent is different from the $values['parent'], then we also need to update all the children
        if ($mapper->tree != @$values['tree'] || $mapper->parent != @$values['parent'] || $mapper->title != @$values['title'] || $mapper->path != @$values['path']) {
            // update children after save
            $update_children = true;
        }
        
        if ($mapper->tree != @$values['tree']) 
        {
        	// update the tree for this node and all descendants
        	$result = $this->getCollection()->update(
        			array(
        					'lft' => array('$gte' => $mapper->lft, '$lte' => $mapper->rgt ),
        					'tree' => (string) $mapper->tree
        			),
        			array(
        					'$set' => array( 'tree' => $values['tree'] )
        			),
        			array(
        					'multiple'=> true
        			)
        	);
        }
    
        if ($updated = $this->save( $values, $options, $mapper ))
        {
            if ($update_children)
            {
                if ($children = $this->emptyState()->setState('filter.parent', (string) $updated->id)->getList())
                {
                    foreach ($children as $child)
                    {
                        $child_values = $child->cast();
                        $child_values['tree'] = $updated->tree; // in case the tree changed in the parent
                        unset($child_values['path']);
                        $this->update( $child, $child_values, array('update_children' => true) );
                    }
                }
            }
        }
    
        return $updated;
    }
    
    public function generatePath( $values )
    {
        $path = null;
    
        //$root = $this->getMapper()->getRoot( $values['tree'] );
        
        if (empty($values['parent']) || $values['parent'] == 'null') {
            $path = "/" . $values['slug'];            
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