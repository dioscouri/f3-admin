<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="login no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="login no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="login no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="login no-js"> <!--<![endif]-->

<head>
    <?php echo $this->renderView('Admin/Views::head.php'); ?>
</head>

<body id="login" class="">
    
	<div id="main" role="main">

		<!-- MAIN CONTENT -->
		<div id="content" class="container">

			<div class="row">
			
				<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
				
                    <tmpl type="system.messages" />
            
                    <tmpl type="view" />				
										
				</div>
			</div>
		</div>
		
    </div>
    <!-- #main -->
    
    <?php echo $this->renderView('Admin/Views::js_footer.php'); ?>
    
    <?php echo $this->renderView('Admin/Views::js_custom.php'); ?>
    
</body>

</html>