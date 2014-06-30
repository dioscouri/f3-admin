<?php if (class_exists('\Search\Factory')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm search">
                <form method="get" action="./admin/search" role="search">
                    <div class="input-group">
                        <input name="q" type="text" class="form-control" placeholder="Global search..." />
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" tabindex="3">Search</button>
                        </span>
                    </div>
                </form>
            </div>            
        </div>        
    </div>
<?php } ?>

<ul class="nav nav-tabs nav-justified" role="tablist">
    <li class="<?php if ($this->app->get('active') == 'today') { echo "active"; } ?>">
        <a href="./admin" class="">
            <h4 class="-heading">Today</h4>
            <p class="-text">...</p>
        </a>
    </li>
    <li class="<?php if ($this->app->get('active') == 'yesterday') { echo "active"; } ?>">
        <a href="./admin/dashboard/yesterday" class="">
            <h4 class="-heading">Yesterday</h4>
            <p class="-text">...</p>
        </a>
    </li>
    <li class="<?php if ($this->app->get('active') == 'last7') { echo "active"; } ?>">
        <a href="./admin/dashboard/last-7" class="">
            <h4 class="-heading">Last 7 Days</h4>
            <p class="-text">...</p>
        </a>
    </li>
    <li class="<?php if ($this->app->get('active') == 'last30') { echo "active"; } ?>">
        <a href="./admin/dashboard/last-30" class="">
            <h4 class="-heading">Last 30 Days</h4>
            <p class="-text">...</p>
        </a>
    </li>
    <li class="<?php if ($this->app->get('active') == 'last90') { echo "active"; } ?>">
        <a href="./admin/dashboard/last-90" class="">
            <h4 class="-heading">Last 90 Days</h4>
            <p class="-text">...</p>
        </a>
    </li>
    <li class="<?php if ($this->app->get('active') == 'custom') { echo "active"; } ?>">
        <a href="./admin/dashboard/custom" class="">
            <h4 class="-heading">Custom</h4>
            <p class="-text">...</p>
        </a>
    </li>                
</ul>

<div class="panel panel-default panel-dashboard">
    <div class="panel-body">
        
        <p class="alert alert-danger">Summary data should all load asynchronously, and where applicable, should update realtime (pusher).</p>
        
        <div class="row">
            <div class="col-md-6">
                <h4 class="clearfix">
                    Visitors
                    <small class="pull-right">X total (y unique)</small>
                </h4>
                <hr/>
                <div class="well well-sm">[Bar chart showing # of Visitors over selected period]</div>
            </div>
            <div class="col-md-3">
                <h4 class="clearfix">
                    Traffic Sources
                    <small class="pull-right">View All</small>
                </h4>
                <hr/>            
                <div class="list-group">
                    <div class="list-group-item">
                        <small>Direct</small>
                        91% (101)
                    </div>
                    
                    <div class="list-group-item">
                        <small>Referrals</small>
                        9% (10)
                    </div>
                    
                    <div class="list-group-item">
                        <small>Search Engines</small>
                        0% (0)
                    </div>
                </div>                
            </div>            
            <div class="col-md-3">
                <h4 class="clearfix">
                    Top Referring Sites
                    <small class="pull-right">View All</small>
                </h4>
                <hr/>            
                <div class="list-group">
                    <div class="list-group-item">
                        google.com
                    </div>
                    
                    <div class="list-group-item">
                        dioscouri.com
                    </div>
                    
                    <div class="list-group-item">
                        yahoo.com
                    </div>
                    
                    <div class="list-group-item">
                        bing.com
                    </div>                    
                </div>            
            </div>
        </div>
        
        <?php // TODO Fire a listener event here ?>
        
        <?php echo $this->renderView('Admin/Views::dashboard/shop_stats.php'); ?>
        
        <tmpl type="modules" name="admin-dashboard-summary-panel" />
        
    </div>
</div>

<?php echo $this->renderView('Admin/Views::dashboard/activity_feed.php'); ?>

<tmpl type="modules" name="admin-dashboard" />

<style>
.panel.panel-default.panel-dashboard {
    border-top: none;
    border-radius: 0px;
}
</style>