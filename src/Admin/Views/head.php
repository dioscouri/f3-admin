
<?php if( $PORT && ($PORT != 80 && $PORT != 443)){?>
<base href="<?php echo $SCHEME . "://" . $HOST.':'.$PORT . $BASE . "/"; ?>" />
<?php } else {?>
<base href="<?php echo $SCHEME . "://" . $HOST . $BASE . "/"; ?>" />
<?php } ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link rel="icon" type="image/ico" href="site/images/favicon.ico" />

<?php $global_settings = \Dsc\Mongo\Collections\Settings::fetch('admin.settings'); ?>
<?php $title = trim( $this->app->get( 'meta.title' ) . ' | Admin ' . $global_settings->{'system.page_title_suffix'} ); ?>
<title><?php echo $title; ?></title>

<!-- Font Awesome -->
<link rel="stylesheet" type="text/css" media="screen" href="./AdminTheme/css/font-awesome.min.css">

<!-- BOOTSTRAP CSS -->
<?php /* ?><link rel="stylesheet" type="text/css" media="all" href="./AdminTheme/css/bootstrap.min.css"> */ ?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
<link rel="stylesheet" type="text/css" media="screen" href="./AdminTheme/css/smartadmin-production.css">
<link rel="stylesheet" type="text/css" media="screen" href="./AdminTheme/css/smartadmin-skins.css">
<link rel="stylesheet" type="text/css" media="screen" href="./AdminTheme/js/plugin/icheck/skins/minimal/blue.css">

<link rel="stylesheet" type="text/css" media="screen" href="./AdminTheme/css/custom_style.css">

<!-- FAVICONS -->
<?php /* ?>
<link rel="shortcut icon" href="./AdminTheme/img/favicon/favicon.ico" type="image/x-icon">
<link rel="icon" href="./AdminTheme/img/favicon/favicon.ico" type="image/x-icon">
*/ ?>

<!-- GOOGLE FONT -->
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
