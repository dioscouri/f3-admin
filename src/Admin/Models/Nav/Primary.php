<?php 
namespace Admin\Models\Nav;

class Primary extends \Admin\Models\Navigation
{
    protected $filename = "admin.nav.primary";
    
    protected $__config = array(
    		'default_sort' => array(
    				'priority' => 1,
    				'lft' => 1,
    		),
    );
    
    public function __construct($config=array())
    {
        parent::__construct($config);
    }
    
    public function fetchConditions(){
    	parent::fetchConditions();
    	
    	$this->setCondition( 'type', 'admin.nav' );	
    	
    	$filter_tree = $this->getState( 'filter.tree' );
    	if( strlen( $filter_tree ) ){
    		$filter_tree = $this->inputfilter()->clean( $filter_tree, 'ALNUM' );
    		$this->setCondition( 'tree', new \MongoId( $filter_tree ) );
    	}
    	
    	return $this;
    }
    
    public function getTreeMenu( $rootID )
    {
    	$tree = array();
		$items = (new static)->setState('filter.tree', $rootID)->getItems();
		if( !empty( $items ) ){
			$idx = -1;
			foreach( $items as $item ){
				if( $item->is_root ) { // root nodes are just names of menus -> skip it
					continue;
				}

				if( $idx == -1 || ((string)$item->parent == $rootID ) ){
					$idx++;
					$item->children = array();
					$tree[$idx] = $item;
				} else {
					$tree[$idx]->children []= $item;
				}
			}
		}
		return $tree;
    }
    
    public function addChildrenItems( $children, $tree, $model ){
    	foreach( $children as $child ) {
    		$child_model = clone $model;
    		$child_model->insert(
    				array(
    						'type'	=> 'admin.nav',
    						'is_root' => false,
    						'tree'	=> $tree,
    						'parent' => $this->id,
    						'priority' => $this->priority,
    				)
    				+ $child
    		);
    	}
    }
}
?>