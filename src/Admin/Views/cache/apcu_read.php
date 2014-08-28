<?php
if (!function_exists('apcu_cache_info')) {
    ?>
    <p class="alert alert-danger">You do not have APCu installed</p>
    <?php
    return;
}
?>

<div>
    <a class="btn btn-info pull-right" href="./admin/cache/apcu">Back</a>
	<h1 class="page-title txt-color-blueDark">
		<i class="fa fa-table fa-fw "></i> 
			APCu
			
			<span> > PHP: <?php echo phpversion() ?></span>
			
			<span> > APCu: <?php echo phpversion('apcu'); ?></span> 
	</h1>        
</div>

<div class="list-group">
    <?php 
    list($val,$time,$ttl)=(array)$this->app->unserialize($this->app->get('data'));
    ?>
    
    <div class="list-group-item">
        Key:
        <?php echo $key; ?> 
    </div>
    
    <div class="list-group-item">
        TTL:
        <?php echo $ttl; ?> 
    </div>
    
    <div class="list-group-item">
        Created:
        <?php echo date('Y-m-d H:i:s', $time); ?> 
    </div>
    
    <div class="list-group-item">
        Value:
        <?php echo \Dsc\Debug::dump( $val ); ?>
    </div>
    
</div>
    