<?php 
$site_users = \Dsc\Mongo\Collections\Sessions::collection()->find(array(
    'user_id' => array('$nin' => array( '', null ) ),
    'timestamp' => array( '$gt' => time() - 300 ),
    'site_id' => 'site'
))->sort(array(
    'timestamp' => -1
));

$site_users_count = $site_users->count();
$site_total_count = \Dsc\Mongo\Collections\Sessions::collection()->count(array(
    'timestamp' => array( '$gt' => time() - 300 ),
    'site_id' => 'site'
));

$admin_users = \Dsc\Mongo\Collections\Sessions::collection()->find(array(
    'user_id' => array('$nin' => array( '', null ) ),
    'timestamp' => array( '$gt' => time() - 300 ),
    'site_id' => 'admin'
))->sort(array(
    'timestamp' => -1
));

$admin_users_count = $admin_users->count();
?>

<div class="row">
    <div class="col-md-6">
    
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="clearfix">
                    <div class="pull-left">
                        <h3 class="panel-title"><i class="fa fa-users"></i> Visitors Online </h3>
                    </div>
                    <div class="pull-right">
                        <?php echo (int) $site_total_count ?> Total (<?php echo (int) $site_users_count; ?> logged in)
                    </div>
                </div>
            </div>
            
            <div class="list-group">
            <?php foreach ($site_users as $user) { ?>
                <div class="list-group-item clearfix">
                    <span class="text-success"><?php echo $user['identity']; ?></span>
                    <span class="pull-right"><?php echo \Dsc\Mongo\Collections\Sessions::ago( $user['timestamp'] ); ?></span>
                </div>
             <?php } ?>
             
             <?php if (empty($site_total_count)) { ?>
                <div class="list-group-item clearfix">
                    None
                </div>
             <?php } else { ?>
                <div class="list-group-item clearfix">
                    <?php echo (int) $site_total_count - $site_users_count; ?> not logged in
                </div>             
             <?php } ?>
            </div>
        </div>
            
    </div>
    
    <div class="col-md-6">
    
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="clearfix">
                    <div class="pull-left">
                        <h3 class="panel-title"><i class="fa fa-users"></i> Admins Online </h3>
                    </div>
                </div>
            </div>
            
            <div class="list-group">
            <?php foreach ($admin_users as $user) { ?>
                <div class="list-group-item clearfix">
                    <span class="text-success"><?php echo $user['identity']; ?></span>
                    <span class="pull-right"><?php echo \Dsc\Mongo\Collections\Sessions::ago( $user['timestamp'] ); ?></span>
                </div>
             <?php } ?>

             <?php if (empty($admin_users_count)) { ?>
                <div class="list-group-item clearfix">
                    None
                </div>
             <?php } ?>
            </div>
        </div>
            
    </div>    
</div>

