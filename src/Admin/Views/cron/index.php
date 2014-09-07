<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i> 
				Cron Jobs 
			<span> > 
				List
			</span>
		</h1>
	</div>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

	</div>
</div>

<form class="searchForm" method="post" action="./admin/cron">

    <?php if (!empty($jobs)) { ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php foreach($jobs as $hash=>$item) { ?>
            <div class="list-group-item">        
                <div class="row">
                    <div class="checkbox-column col-xs-1 col-sm-1 col-md-1">
                        <?php echo $item->getActive() ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>'; ?>
                    </div>
                                                
                    <div class="col-xs-11 col-sm-11 col-md-11">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-10">
                                <?php echo $item->getCommand(); ?>
                                <?php if ($item->getComments()) { ?>
                                <p class="help-block"><?php echo $item->getComments(); ?></p>
                                <?php } ?>
                                <p class="help-block">Hash: <?php echo $hash; ?></p>                                
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-1">
                                <a class="btn btn-sm btn-warning" href="./admin/cron/disable/<?php echo $hash; ?>" data-bootbox="confirm">Disable</a>
                            </div>
                            <div class="col-xs-12 col-sm-2 col-md-1">
                                <a class="btn btn-sm btn-danger" href="./admin/cron/delete/<?php echo $hash; ?>" data-bootbox="confirm">Delete</a>
                            </div>                                                        
                        </div>

                    </div>
                </div>
            </div>
            <?php } ?>
            
            <div class="list-group-item">
                <div class="row">
                    <div class="col-sm-10">

                    </div>
                    <div class="col-sm-2">
                        <div class="pull-right">
                            <span class="pagination">
                                <?php echo count($jobs); ?> total
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php } else { ?>
                <div class="">No items found.</div>
            <?php } ?>
        
        </div>
    </div>
</form>