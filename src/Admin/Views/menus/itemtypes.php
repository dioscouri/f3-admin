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
                <form class="" action="./admin/menu/create" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="link-url" placeholder="URL" name="details[url]">
                    </div>
                    
                    <div class="form-group">
                        <input type="text" class="form-control" id="link-title" placeholder="Title of Menu Item" name="title">
                    </div>
                    
                    <!-- /.form-group -->
                    <div class="form-group">
                        <select name="published" class="form-control">
                            <option value="1">Published</option>
                            <option value="0">Not Published</option>
                        </select>
                    </div>
                    

                    <div class="form-group">
                        <label>Parent</label>

                        <select id="parent" name="parent" class="form-control">
                            <optgroup label="No Parent">
                                <option  value="null">Menu Root</option>
                            </optgroup>
                            
                            <?php if (!empty($all)) { foreach ($all as $one) { ?>
                                <?php
                               
                                
                                // display the options grouped by tree 
                                if (empty($current_tree) || $current_tree != $one->tree) {
                                    if (!empty($current_tree)) {
                                        ?></optgroup><?php
                                    }
                                    $current_tree = $one->tree;
                                    ?>
                                    <optgroup label="<?php echo $one->title; ?>">
                                    <?php
                                }
                                ?>
                                
                                <?php if ($one->id == $current_tree) { ?>
                                <option data-tree="<?php echo $one->tree; ?>" value="<?php echo $one->id; ?>" >Top Level of <?php echo $one->title; ?></option>                        
                                <?php } else { ?>
                                <option data-tree="<?php echo $one->tree; ?>" value="<?php echo $one->id; ?>" ><?php echo @str_repeat( "&ndash;", substr_count( @$one->path, "/" ) - 1 ) . " " . $one->title; ?></option>
                                <?php } ?>
                            <?php } } ?>
                            
                            <?php if (!empty($all)) { ?>
                            </optgroup>
                            <?php } ?>
                            
                        </select>
                    </div>    

                    <!-- /.form-group -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Add to Menu</button>
                        <input type="hidden" name="tree" value="<?php echo $tree; ?>" />
                        <input type="hidden" name="details[type]" value="link" />
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