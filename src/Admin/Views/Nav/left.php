<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel" class="">

    <!-- User info -->
    <div class="login-info">
	    <?php $identity = $this->auth->getIdentity(); ?>
		<span> <a href="javascript:void(0);" id="show-shortcut"> <?php echo $identity->fullName(); ?> </a>
        </span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive

	To make this navigation dynamic please make sure to link the node
	(the reference to the nav > ul) after page load. Or the navigation
	will not initialize.
	-->
    <nav class="primary-nav">
        <!-- NOTE: Notice the gaps after each icon usage <i></i>..
		Please note that these links work a bit different than
		traditional hre="" links. See documentation for details.
		-->
        <?php 
        $current = str_replace( $BASE, '', $URI );
        $active_has_been_found = false;
        $list = (new \Admin\Models\Nav\Primary)->setState('filter.root', false)->setState('filter.tree', \Admin\Models\Settings::fetch()->get('admin_menu_id') )->setState('order_clause', array( 'tree'=> 1, 'lft' => 1 ))->getItems();
        ?>
        
        <ul>
            <li>
                <a href="./admin" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
        
        <?php
        foreach ($list as $key => $item) 
        {
            $class = !empty($item->class) ? $item->class : 'menu-item';
            
            $selected = ($current == $item->route) 
                        || (!empty($item->base) && strpos($current, $item->base) !== false) 
                        || (\Dsc\String::inStrings(\Joomla\Utilities\ArrayHelper::getColumn($item->getDescendants(), 'route'), $current ))
                        ;
            
            if ($selected || (strpos($item->route, $PARAMS[0]) !== false && !$found)) {
                $found = true;
                $class .= " active open";
            }
            
            if ($item->hasDescendants()) {
            	$class .= " dropdown";
            }
            
            if (empty($item->route)) {
            	$item->route = 'javascript:void(0);';
            }
            
        	echo '<li class="' . $class . '">';
        	
        	// is this a module?
            // or just a regular link?
            echo '<a href="' . $item->route . '" style="">';
                if (!empty($item->icon)) {
                	echo '<i class="fa fa-lg fa-fw ' . $item->icon . '"></i>';
                }
                echo ' <span class="menu-item-parent">';
                echo $item->title;
                echo '</span> ';
            echo '</a>';
        
        	// The next item is deeper.
        	if (isset($list[$key+1]) && $list[$key+1]->getDepth() > $item->getDepth()) {
        	    echo '<ul>';	
        	}
        	// The next item is shallower.
        	elseif (isset($list[$key+1]) && $item->getDepth() > $list[$key+1]->getDepth()) {
        		echo '</li>';
        		echo str_repeat('</ul></li>', $item->getDepth() - $list[$key+1]->getDepth());
        	}
        	// The next item is on the same level.
        	else {
        		echo '</li>';
        	}
        }
        ?></ul>
        
    </nav>
    <span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i>
    </span>

</aside>
<!-- END NAVIGATION -->