<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" class="default <?php echo @$html_class; ?>">
<head>
    <?php echo $this->renderLayout('common/head.php'); ?>
    <link rel="stylesheet" href="./a/css/Login.css" type="text/css" />
    <script src="./a/js/Login.js"></script>
</head>
<body class="dsc-wrap <?php echo !empty($body_class) ? $body_class : 'default'; ?>">

<div id="login-container">
    
    <tmpl type="system.messages" />
    
    <tmpl type="view" />
    
</div> <!-- #wrapper -->

</body>

</html>