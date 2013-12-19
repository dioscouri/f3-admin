<?php //echo \Dsc\Debug::dump( $quickadd, false ); ?>

<div class="panel-group accordion" id="accordion">

    <div class="panel panel-default open">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent=".accordion" href="#collapse-links"> Links </a>
            </h4>
        </div>

        <div id="collapse-links" class="panel-collapse in">
            <div class="panel-body">
                <form class="form-horizontal" action="./admin/menu" method="post">
                    <div class="form-group">
                        <label for="link-url" class="col-sm-4 control-label">URL</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="link-url" placeholder="URL" name="details[url]">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="link-text" class="col-sm-4 control-label">Link Text</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="link-title" placeholder="Title of Menu Item" name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-default">Add to Menu</button>
                            <input type="hidden" name="tree" value="<?php echo $PARAMS['id']; ?>" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.panel-default -->

    <?php if ($items = (array) $quickadd->getArgument('items')) { ?>
        <?php foreach ($items as $key=>$item) { ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent=".accordion" href="#collapse-<?php echo $key; ?>"> <?php echo $item->title; ?> </a>
                </h4>
            </div>
    
            <div id="collapse-<?php echo $key; ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <?php echo $item->form; ?>
                </div>
            </div>
        </div>
        <!-- /.panel-default -->
        <?php } ?>
    <?php } ?>

</div>