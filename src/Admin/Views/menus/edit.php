<?php // echo \Dsc\Debug::dump( $flash->get('old'), false ); ?>

<script>
jQuery(document).ready(function(){
    jQuery('#parent').change(function(){
        var tree = jQuery(this).find(':selected').attr('data-tree');
        if (tree) {
            jQuery('#tree').val(tree);
        }
    });
});
</script>

<form id="detail-form" action="./admin/menu/<?php echo $item->get( $model->getItemKey() ); ?>" class="form" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" placeholder="Title" value="<?php echo $flash->old('title'); ?>" class="form-control" />
                <input id="tree" name="tree" value="<?php echo $flash->old('tree'); ?>" type="hidden">
            </div>
            <!-- /.form-group -->
            
            <?php if (!empty($all)) { ?>
            <div class="form-group">
                <label for="parent">Parent</label>
                <select id="parent" name="parent" class="form-control ui-select2">
                    <?php foreach ($all as $one) { ?>
                        <?php
                        if (strpos($one->path, $item->path) !== false) {
                            // an item cannot be its own descendant
                            continue;
                        }
                        
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
                        <option data-tree="<?php echo $one->tree; ?>" value="<?php echo $one->id; ?>" <?php if ($one->id == $flash->old('parent')) { echo "selected='selected'"; } ?>>Top Level of <?php echo $one->title; ?></option>                        
                        <?php } else { ?>
                        <option data-tree="<?php echo $one->tree; ?>" value="<?php echo $one->id; ?>" <?php if ($one->id == $flash->old('parent')) { echo "selected='selected'"; } ?>><?php echo @str_repeat( "&ndash;", substr_count( @$one->path, "/" ) - 1 ) . " " . $one->title; ?></option>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if (!empty($all)) { ?>
                    </optgroup>
                    <?php } ?>
                    
                </select>
            </div>
            <!-- /.form-group -->
            <?php } ?>
            
            
            <div class="form-actions">

                <div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <input id="primarySubmit" type="hidden" value="save_edit" name="submitType" />
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a onclick="document.getElementById('primarySubmit').value='save_close'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save & Close</a>
                            </li>
                        </ul>
                    </div>
                        
                    &nbsp;
                    <a class="btn btn-default" href="./admin/menus/<?php echo $item->tree; ?>">Cancel</a>
                </div>

            </div>
            <!-- /.form-group -->
    
        </div>
        
    </div>
</form>