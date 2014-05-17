<?php
namespace Admin\Models\Nav;

class Primary extends \Admin\Models\Navigation
{
    protected $__type = "admin.nav";

    protected $__config = array(
        'default_sort' => array(
            'priority' => 1,
            'lft' => 1
        )
    );

    public function fetchConditions()
    {
        parent::fetchConditions();
        
        $this->setCondition('type', $this->type());
        
        return $this;
    }

    public static function getTreeMenu($rootID)
    {
        $tree = array();
        $items = (new static())->setState('filter.tree', $rootID)->getItems();
        if (!empty($items))
        {
            $idx = -1;
            foreach ($items as $item)
            {
                if ($item->is_root)
                {
                    // root nodes are just names of menus -> skip it
                    continue;
                }
                
                if ($idx == -1 || ((string) $item->parent == $rootID))
                {
                    $idx++;
                    $item->children = array();
                    $tree[$idx] = $item;
                }
                else
                {
                    $tree[$idx]->children[] = $item;
                }
            }
        }
        return $tree;
    }

    /**
     *
     * @param unknown $children
     */
    public function addChildren( array $children )
    {
        foreach ($children as $child)
        {
            (new static)->insert(array(
                'type' => 'admin.nav',
                'is_root' => false,
                'tree' => $this->tree,
                'parent' => $this->id,
                'priority' => $this->priority
            ) + $child);
        }
        
        return $this;
    }
}
?>