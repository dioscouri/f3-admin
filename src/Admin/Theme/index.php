<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
    <?php echo $this->renderView('Admin/Views::head.php'); ?>
</head>

<body class="clearfix <?php echo !empty($body_class) ? $body_class : ''; ?>">

    <?php echo $this->renderView('Admin/Views::js_footer.php'); ?>
    
    <?php echo $this->renderView('Admin/Views::js_custom.php'); ?>

    <?php echo $this->renderView('Admin/Views::header.php'); ?>
    
    <?php echo $this->renderView('Admin/Views::Nav/left.php'); ?>

    <div id="main" role="main" class="clearfix">
        
		<div id="ribbon">
		<?php // breadcrumb? ?>
		</div>
		<!-- #ribbon -->
		
    	<div id="content" class="clearfix">		
    
            <tmpl type="system.messages" />
    
            <tmpl type="view" />
        
        </div> <!-- #content -->
		
    </div>
    <!-- #main -->
    
    <?php // echo $this->renderView('Admin/Views::footer.php'); ?>
    
</body>

</html>