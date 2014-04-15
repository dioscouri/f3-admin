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

        $this->filter_fields = array_merge( $this->filter_fields, array(
            'ordering', 'path'
        ) );
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
        if (!empty($filter_tree)) {
            $this->filters['tree'] = new \MongoId((string) $filter_tree );
        }
    
        $filter_parent = $this->getState('filter.parent');
        if (!empty($filter_parent)) {
            $this->filters['parent'] = new \MongoId((string) $filter_parent );
        }
        
        $filter_published = $this->getState('filter.published');
        if ($filter_published || (int) $filter_published == 1) {
            // only published items, using both publication dates and published field
            $this->filters['published'] = true;
        } elseif ((is_bool($filter_published) && !$filter_published) || (strlen($filter_published) && (int) $filter_published == 0)) {
            // only unpublished items
            $this->filters['published'] = array( '$ne' => true );
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
        } else {
        	$values['parent'] = new \MongoId((string) $values['parent']);
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
        
        $values['tree'] = new \MongoId( (string) $values['tree'] );
    
        // if no slug exists, generate it and make sure it's unique
        if (empty($values['slug']))
        {
            $values['slug'] = \Joomla\Filter\OutputFilter::stringURLUnicodeSlug($values['title']);
        }
    
        // if no parent is set, set it
        if (!isset($values['parent']) || $values['parent'] == "null")
        {
            $values['parent'] = null;
        } else {
        	$values['parent'] = new \MongoId((string) $values['parent']);
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
    
    /**
     * Clone an item.  Data from $values takes precedence of data from cloned object.
     *
     * @param unknown_type $mapper
     * @param unknown_type $values
     * @param unknown_type $options
     */
    public function saveAs( $mapper, $values, $options=array() )
    {
        $item_data = $mapper->cast();
        $new_values = array_merge( $values, array_diff_key( $item_data, $values ) );
        unset($new_values[$this->getItemKey()]);
        unset($new_values['path']);
        if ($new_values['slug'] == $item_data['slug']) {
            unset($new_values['slug']);
        }
            
        return $this->save( $new_values, $options );
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
        	// update the tree value for this node and all descendants
        	$result = $this->getCollection()->update(
        			array(
        					'lft' => array('$gte' => $mapper->lft, '$lte' => $mapper->rgt ),
        					'tree' => $mapper->tree
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
                if ($children = $this->emptyState()->setState('filter.parent', $updated->id)->getList())
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
    
        if (empty($values['parent']) || $values['parent'] == 'null') {
            if (empty($values['is_root'])) {
                if ($root = $this->getMapper()->getRoot( $values['tree'] )) {
                    $path .= $root->path;
                }
            }
            $path .= "/" . $values['slug'];            
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
}