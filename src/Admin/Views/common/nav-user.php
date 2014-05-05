<ul class="nav navbar-nav pull-right">
    <li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
			<i class="fa fa-user"></i>
        	<?php echo \Base::instance()->get('SESSION.auth-identity.admin')->username; ?> 
        	<span class="caret"></span>
    	</a>
    	
    	<ul class="dropdown-menu" role="menu">
	        <li>
	        	<a href="/admin/logout">
	        		<i class="fa fa-sign-out"></i> 
	        		&nbsp;&nbsp;Logout
	        	</a>
	        </li>    	
    	</ul>
    </li>
</ul>

<?php /* ?>
<ul class="nav navbar-nav pull-right">
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:;">
			<i class="fa fa-user"></i>
        	Rod Howard 
        	<span class="caret"></span>
    	</a>

    	<ul class="dropdown-menu" role="menu">
	        <li>
	        	<a href="/page-profile.html">
	        		<i class="fa fa-user"></i> 
	        		&nbsp;&nbsp;My Profile
	        	</a>
	        </li>
	        <li>
	        	<a href="/page-calendar.html">
	        		<i class="fa fa-calendar"></i> 
	        		&nbsp;&nbsp;My Calendar
	        	</a>
	        </li>
	        <li>
	        	<a href="/page-settings.html">
	        		<i class="fa fa-cogs"></i> 
	        		&nbsp;&nbsp;Settings
	        	</a>
	        </li>
	        <li class="divider"></li>
	        <li>
	        	<a href="/page-login.html">
	        		<i class="fa fa-sign-out"></i> 
	        		&nbsp;&nbsp;Logout
	        	</a>
	        </li>
    	</ul>
    </li>
</ul>
<?php */ ?>
