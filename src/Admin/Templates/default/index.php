<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class="default <?php echo @$html_class; ?>">
<head>
    <?php echo $this->renderLayout('common/head.php'); ?>
</head>
<body class="dsc-wrap standard <?php echo !empty($body_class) ? $body_class : 'default'; ?>">

<div id="wrapper">

    <?php echo $this->renderLayout('common/header.php'); ?>

	<nav id="top-bar" class="collapse top-bar-collapse">

	    <?php echo $this->renderLayout('common/nav-top.php'); ?>
		
		<?php echo $this->renderLayout('common/nav-user.php'); ?>

	</nav> <!-- /#top-bar -->
	
	<div id="sidebar-wrapper" class="collapse sidebar-collapse">
	
	    <?php echo $this->renderLayout('common/global-search.php'); ?>
	
		<nav id="sidebar">		
	
            <?php echo $this->renderLayout('common/nav-primary.php'); ?>
					
		</nav> <!-- #sidebar -->

	</div> <!-- /#sidebar-wrapper -->
	
	<div id="content">		
		
		<div id="content-header">
		    <?php if (!empty($pagetitle)) { ?>
			<h1>
			    <span><?php echo $pagetitle; ?></span>
			    
                <?php if (!empty($subtitle)) { ?>
                <small class="subtitle">
                    <span><?php echo $subtitle; ?></span>
                </small>
                <?php } ?>			    
			</h1>
			<?php } ?>
		</div> <!-- #content-header -->	


		<div id="content-container">
    
            <tmpl type="system.messages" />
    
            <tmpl type="view" />
        
		</div> <!-- /#content-container -->
		

	</div> <!-- #content -->
    
</div> <!-- #wrapper -->

<?php echo $this->renderLayout('common/footer.php'); ?>

</body>

</html>