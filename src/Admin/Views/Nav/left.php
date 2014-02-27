<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel" class="">

    <!-- User info -->
    <div class="login-info">
	    <?php //$identity = $this->auth->getIdentity(); ?>
		<span> <a href="javascript:void(0);" id="show-shortcut"> <?php //echo \Dsc\Lib\ArrayHelper::get($identity, 'name'); ?> </a>
        </span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive

	To make this navigation dynamic please make sure to link the node
	(the reference to the nav > ul) after page load. Or the navigation
	will not initialize.
	-->
    <nav>
        <!-- NOTE: Notice the gaps after each icon usage <i></i>..
		Please note that these links work a bit different than
		traditional hre="" links. See documentation for details.
		-->
        <?php 
        $current = str_replace( $BASE, '', $URI );
        $items = (new \Admin\Models\Nav\Primary)->setState('order_clause', 'priority SORT_ASC, title, SORT_ASC')->getList();
        $active_has_been_found = false;
        ?>
        <ul>
            <li>
                <a href="./admin" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a>
            </li>
            
        	<?php if ($items) { foreach ($items as $item) { ?>
        	<li <?php if (!empty($item->id)) {echo 'id="'.$item->id.'"';}?>   class="<?php if ($current == $item->route || (!empty($item->base) && strpos($current, $item->base) !== false) || \Dsc\String::inStrings(\Joomla\Utilities\ArrayHelper::getColumn($item->children, 'route'), $current ) ) { echo 'active'; } ?> <?php echo !empty($item->children) ? 'dropdown' : null; ?> ">
        		<a href="<?php echo !empty($item->children) ? 'javascript:;' : '.' . $item->route; ?>" title="<?php echo $item->title; ?>">
        			<?php if (!empty($item->icon)) { ?><i class="fa fa-lg fa-fw <?php echo $item->icon; ?>"></i><?php } ?> <?php if (!empty($item->title)) { ?><span class="menu-item-parent"><?php echo $item->title; ?></span> <?php } ?>
        		</a>
        		<?php if (!empty($item->children)) { ?>
        		<ul class="sub-nav">
        		    <?php foreach ($item->children as $child_array) { $child = \Joomla\Utilities\ArrayHelper::toObject($child_array); ?>
        		    <?php if (empty($child->hidden)) { ?>
        			<li class="<?php if (strpos($current, $child->route) !== false && !$active_has_been_found && substr_count($current, '/') == substr_count($child->route, '/')) { echo 'active'; $active_has_been_found = true; } ?>">
        			    <a href=".<?php echo $child->route; ?>">
            			<?php if (!empty($child->icon)) { ?><i class="<?php echo $child->icon; ?>"></i><?php } ?>
            			<?php if (!empty($child->title)) { ?><span class="title"><?php echo $child->title; ?></span> <?php } ?>
            			</a>
        			</li>
        			<?php } ?>
        			<?php } ?>
                </ul>
        		<?php } ?>		
        	</li>
        	<?php } } ?>
        </ul>
    </nav>
    <span class="minifyme"> <i class="fa fa-arrow-circle-left hit"></i>
    </span>

</aside>
<!-- END NAVIGATION -->