<!-- HEADER -->
<header id="header">
	<div id="logo-group" class="hidden-xs hidden-sm">

		<!-- PLACE YOUR LOGO HERE -->
		<?php /* ?> <span id="logo"> <img src="img/logo.png" alt="Admin Logo"> </span>  */ ?>
		<span id="logo"> ADMIN </span>
		<!-- END LOGO PLACEHOLDER -->
		
	</div>

	<!-- pulled right: nav area -->
	<div class="pull-right">
        
		<!-- collapse menu button -->
		<div id="hide-menu" class="btn-header pull-right">
			<span> <a href="javascript:void(0);" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
		</div>
		<!-- end collapse menu -->

		<!-- logout button -->
		<div id="logout" class="btn-header transparent pull-right">
			<span> <a class="" href="./admin/logout" title="Sign Out">&nbsp;<i class="fa fa-sign-out"></i> <small class="hidden-xs hidden-sm">Logout</small> &nbsp;</a> </span>
		</div>
		<!-- end logout button -->
		
		<!-- preview button -->
		<div id="preview" class="btn-header transparent pull-right">
			<span> <a class="" href="./" title="Preview Site" target="_blank" >&nbsp;<i class="fa fa-circle-thin"></i> <small class="hidden-xs hidden-sm">Preview Site</small> &nbsp;</a> </span>
		</div>
		<!-- end preview button -->
		
        <h4 class="pull-right margin-top greeting">
            <span class="">
            <?php $identity = $this->auth->getIdentity(); ?>
            Hello, <?php echo $identity->fullName(); ?>
            </span>
        </h4>

		<?php /* ?>
		<!-- search mobile button (this is hidden till mobile view port) -->
		<div id="search-mobile" class="btn-header transparent pull-right">
			<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
		</div>
		<!-- end search mobile button -->

		<!-- input: search field -->
		<form action="#search.html" class="header-search pull-right">
			<input type="text" placeholder="Search..." id="search-fld">
			<button type="submit">
				<i class="fa fa-search"></i>
			</button>
			<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
		</form>
		<!-- end input: search field -->
		*/ ?>

	</div>
	<!-- end pulled right: nav area -->

</header>
<!-- END HEADER -->
