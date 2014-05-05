<?php 
$current = str_replace( $BASE, '', $URI );
$items = (new \Admin\Models\Nav\Primary)->setState('order_clause', 'priority SORT_ASC, title, SORT_ASC')->getList();
$active_has_been_found = false;
?>

<ul id="main-nav" class="open-active">
	<li class="<?php if ($PATTERN == "/admin") { echo 'active'; } ?>">
		<a href="/admin">
			<i class="fa fa-dashboard"></i>
			Dashboard
		</a>	
	</li>
	
	<?php if ($items) { foreach ($items as $item) { ?>
	<li  <?php if (!empty($item->id)) {echo 'id="'.$item->id.'"';}?>   class="<?php if ($current == $item->route || (!empty($item->base) && strpos($current, $item->base) !== false) || \Dsc\String::inStrings(\Joomla\Utilities\ArrayHelper::getColumn($item->children, 'route'), $current ) ) { echo 'active'; } ?> <?php echo !empty($item->children) ? 'dropdown' : null; ?> ">
		<a href="<?php echo !empty($item->children) ? 'javascript:;' : '.' . $item->route; ?>">
			<?php if (!empty($item->icon)) { ?><i class="<?php echo $item->icon; ?>"></i><?php } ?>
			<?php if (!empty($item->title)) { ?><span class="title"><?php echo $item->title; ?></span> <?php } ?>
			<?php if (!empty($item->children)) { ?>
			    <span class="caret"></span>
			<?php } ?>
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

<?php /* ?>

<ul id="main-nav" class="open-active">			

	<li class="active">				
		<a href="/index.html">
			<i class="fa fa-dashboard"></i>
			Dashboard
		</a>				
	</li>
				
	<li class="dropdown">
		<a href="javascript:;">
			<i class="fa fa-file-text"></i>
			Example Pages
			<span class="caret"></span>
		</a>				
		
		<ul class="sub-nav">
			<li>
				<a href="/page-profile.html">
					<i class="fa fa-user"></i> 
					Profile
				</a>
			</li>
			<li>
				<a href="/page-invoice.html">
					<i class="fa fa-money"></i> 
					Invoice
				</a>
			</li>
			<li>
				<a href="/page-pricing.html">
					<i class="fa fa-dollar"></i> 
					Pricing Plans
				</a>
			</li>
			<li>
				<a href="/page-support.html">
					<i class="fa fa-question"></i> 
					Support Page
				</a>
			</li>
			<li>
				<a href="/page-gallery.html">
					<i class="fa fa-picture-o"></i> 
					Gallery
				</a>
			</li>
			<li>
				<a href="/page-settings.html">
					<i class="fa fa-cogs"></i> 
					Settings
				</a>
			</li>
			<li>
				<a href="/page-calendar.html">
					<i class="fa fa-calendar"></i> 
					Calendar
				</a>
			</li>
		</ul>						
		
	</li>	
	
	<li class="dropdown">
		<a href="javascript:;">
			<i class="fa fa-tasks"></i>
			Form Elements
			<span class="caret"></span>
		</a>
		
		<ul class="sub-nav">
			<li>
				<a href="/form-regular.html">
					<i class="fa fa-location-arrow"></i>
					Regular Elements
				</a>
			</li>
			<li>
				<a href="/form-extended.html">
					<i class="fa fa-magic"></i>
					Extended Elements
				</a>
			</li>	
			<li>
				<a href="/form-validation.html">
					<i class="fa fa-check"></i>
					Validation
				</a>
			</li>			
		</ul>	
						
	</li>
	
	<li class="dropdown">
		<a href="javascript:;">
			<i class="fa fa-desktop"></i>
			UI Features
			<span class="caret"></span>
		</a>	

		<ul class="sub-nav">
			<li>
				<a href="/ui-buttons.html">
					<i class="fa fa-hand-o-up"></i>
					Buttons
				</a>
			</li>
			<li>
				<a href="/ui-tabs.html">
					<i class="fa fa-reorder"></i>
					Tabs & Accordions
				</a>
			</li>

			<li>
				<a href="/ui-popups.html">
					<i class="fa fa-asterisk"></i>
					Popups / Notifications
				</a>
			</li>	

			<li>
				<a href="/ui-sliders.html">
					<i class="fa fa-tasks"></i>
					Sliders
				</a>
			</li>	
	
			<li class="">
				<a href="/ui-typography.html">
					<i class="fa fa-font"></i>
					Typography
				</a>
			</li>	
	
			<li class="">
				<a href="/ui-icons.html">
					<i class="fa fa-star-o"></i>
					Icons
				</a>
			</li>	
		</ul>
	</li>
	
	<li class="dropdown">
		<a href="javascript:;">
			<i class="fa fa-table"></i>
			Tables
			<span class="caret"></span>
		</a>
		
		<ul class="sub-nav">
			<li>
				<a href="/table-basic.html">
					<i class="fa fa-table"></i> 
					Basic Tables
				</a>
			</li>		
			<li>
				<a href="/table-advanced.html">
					<i class="fa fa-table"></i> 
					Advanced Tables
				</a>
			</li>
			<li>
				<a href="/table-responsive.html">
					<i class="fa fa-table"></i> 
					Responsive Tables
				</a>
			</li>	
		</ul>	
						
	</li>

	<li>
		<a href="/ui-portlets.html">
			<i class="fa fa-list-alt"></i>
			Portlets
		</a>
	</li>
	
	<li class="dropdown">
		<a href="javascript:;">
			<i class="fa fa-bar-chart-o"></i>
			Charts & Graphs
			<span class="caret"></span>
		</a>
		
		<ul class="sub-nav">
			<li>
				<a href="/chart-flot.html">
					<i class="fa fa-bar-chart-o"></i> 
					jQuery Flot
				</a>
			</li>
			<li>
				<a href="/chart-morris.html">
					<i class="fa fa-bar-chart-o"></i> 
					Morris.js
				</a>
			</li>
		</ul>
	</li>
	
	<li class="dropdown">
		<a href="javascript:;">
			<i class="fa fa-file-text-o"></i>
			Extra Pages
			<span class="caret"></span>
		</a>
		
		<ul class="sub-nav">
			<li>
				<a href="/page-login.html">
					<i class="fa fa-unlock"></i> 
					Login Basic
				</a>
			</li>
			<li>
				<a href="/page-login-social.html">
					<i class="fa fa-unlock"></i> 
					Login Social
				</a>
			</li>
			<li>
				<a href="/page-404.html">
					<i class="fa fa-ban"></i> 
					404 Error
				</a>
			</li>
			<li>
				<a href="/page-500.html">
					<i class="fa fa-ban"></i> 
					500 Error
				</a>
			</li>
			<li>
				<a href="/page-blank.html">
					<i class="fa fa-file-text-o"></i> 
					Blank Page
				</a>
			</li>
		</ul>
	</li>

</ul>

<?php */ ?>