<?php //echo \Dsc\Debug::dump( $quickadd, false ); ?>

<div class="row">
    <div class="col-md-12">
        <div class="well clearfix">
            <div class="col-sm-6">
                <?php if (!empty($parents)) { ?>
                <form class="form-inline" role="form" action="./admin/menus" method="get">
                    <div class="form-group">Select a menu to edit:</div>
                    <div class="form-group" id="parents">
                        <?php echo $this->renderLayout('Admin/Views::menus/list_parents.php'); ?>
                    </div>
                </form>
                <?php } ?>
            </div>
            <div class="col-sm-6">
                <form class="pull-right form-inline" action="./admin/menu" method="post">
                    <div class="form-group">Create a new menu:</div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="new_menu_title" placeholder="New Menu Title" name="title">
                    </div>
                    <div class="form-group form-actions">
                        <input type="hidden" name="is_root" value="1">
                        <button type="submit" class="btn btn-default">Create</button>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($list)) { ?>
<div class="row">
    <div class="col-md-12">
        <h3 class="clearfix">
            <?php echo $item->title; ?>
            <a href="./admin/menu/<?php echo $selected; ?>/edit">
                <small>Rename</small>
            </a>
            <a href="./admin/menu/<?php echo $selected; ?>/delete" class="btn btn-xs btn-danger pull-right" data-bootbox="confirm">Delete Menu</a>
        </h3>

        <hr />

    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="portlet portlet-plain">
            <div class="portlet-header">
                <h3 class="pull-left">Quick-Add to Menu</h3>
                <span class="pull-right">
                    <a class="label label-default" href="javascript:void(0);">Advanced Add</a>
                </span>
            </div>
            <!-- /.portlet-header -->
            <div class="portlet-content">
                <?php echo $this->renderLayout('Admin/Views::menus/itemtypes.php'); ?>            
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <form id="categories" class="searchForm" action="./admin/menus/<?php echo $PARAMS['id']; ?>" method="post">
        
            <?php echo $this->renderLayout('Admin/Views::menus/list_datatable.php'); ?>
        
        </form>
    </div>
</div>
<?php } ?>