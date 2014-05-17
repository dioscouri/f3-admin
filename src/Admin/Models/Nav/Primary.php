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

    /**
     *
     * @param array $children
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