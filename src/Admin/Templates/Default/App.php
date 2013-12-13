<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class="default <?php echo @$html_class; ?>">
<head>
    <?php echo $this->renderLayout('common/head.php'); ?>
</head>
<body class="dsc-wrap app <?php echo !empty($body_class) ? $body_class : 'default'; ?>">

<div id="wrapper">

    <div id="content">
    
        <div id="app-container">
        
            <tmpl type="system.messages" />
        
            <tmpl type="view" />
        
        </div> <!-- /#content-container -->

    </div> <!-- #content -->
    
</div> <!-- #wrapper -->

</body>

</html>