<?php //echo \Dsc\Debug::dump( $quickadd, false ); ?>

<?php if (empty($roots)) { ?>
    <div class="alert alert-warning">Please create a menu to begin</div>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="well clearfix">
            <div class="col-sm-6">
                <?php if (!empty($roots)) { ?>
                <form class="form-inline" role="form" action="./admin/menus" method="get">
                    <div><label>Select a menu to edit:</label></div>
                    <div class="form-group" id="parents">
                        <?php echo $this->renderLayout('Admin/Views::menus/list_parents.php'); ?>
                    </div>
                </form>
                <?php } ?>
            </div>
            <div class="col-sm-6">
                <form class="pull-right form-inline" action="./admin/menu/create" method="post">
                    <label>or create a new menu:</label>
                    <div class="input-group">
                        <input type="hidden" name="is_root" value="1">
                        <input type="text" class="form-control" id="new_menu_title" placeholder="New Menu Title" name="title">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">Create</button>
                        </span>                        
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
            <a href="./admin/menu/edit/<?php echo $selected; ?>">
                <small>Edit</small>
            </a>
            <a href="./admin/menu/delete/<?php echo $selected; ?>" class="btn btn-xs btn-danger pull-right" data-bootbox="confirm">Delete Menu</a>
        </h3>

        <hr />

    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="portlet portlet-plain">
            <div class="portlet-header">
                <h3>Quick-Add to Menu</h3>
                <?php /* ?>
                <span class="pull-right"> <a class="label label-default" href="javascript:void(0);">Advanced Add</a>
                */ ?>
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