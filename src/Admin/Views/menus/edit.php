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
        
            <div class="form-actions clearfix">

                <div class="pull-right">
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
            <!-- /.form-actions -->
            
            <hr />
        
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab-basics" data-toggle="tab"> Basics </a>
                </li>
                <li>
                    <a href="#tab-display" data-toggle="tab"> Display </a>
                </li>
                <?php foreach ((array) $this->event->getArgument('tabs') as $key => $title ) { ?>
                <li>
                    <a href="#tab-<?php echo $key; ?>" data-toggle="tab"> <?php echo $title; ?> </a>
                </li>
                <?php } ?>
            </ul>
            
            <div class="tab-content">

                <div class="tab-pane active" id="tab-basics">
                
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" placeholder="Title" value="<?php echo $flash->old('title'); ?>" class="form-control" /> 
                        <input id="tree" name="tree" value="<?php echo $flash->old('tree'); ?>" type="hidden">
                        <input name="details[type]" value="<?php echo $flash->old('details.type'); ?>" type="hidden">
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" name="details[url]" placeholder="URL" value="<?php echo $flash->old('details.url'); ?>" class="form-control" />
                    </div>
                    <!-- /.form-group -->
                    
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" placeholder="Slug" value="<?php echo $flash->old('slug'); ?>" class="form-control" />
                    </div>
                    <!-- /.form-group -->
        
                    <div class="form-group">
                        <label>Published</label>
                        <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="published" value="1" <?php if ($flash->old('published') == true) { echo 'checked'; } ?>> Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="published" value="0" <?php if ($flash->old('published') != true) { echo 'checked'; } ?>> No
                        </label>
                        </div>
                    </div>
                    <!-- /.form-group -->
                    
                    <?php if (!empty($all)) { ?>
                    <div class="form-group">
                        <label for="parent">Parent</label>
                        <select id="parent" name="parent" class="form-control ui-select2">
                            <optgroup label="No Parent">
                                <option data-tree="<?php echo $item->id; ?>" value="null" <?php if (null == $flash->old('parent')) { echo "selected='selected'"; } ?>>Menu Root</option>
                            </optgroup>
                            
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
                
                </div>
                
                <div class="tab-pane" id="tab-display">
                
                    <div class="form-group">
                        <label>Display Title</label>
                        <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="display_title" value="1" <?php if (is_null($flash->old('display_title')) || $flash->old('display_title') == '1') { echo 'checked'; } ?>> Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="display_title" value="0" <?php if ($flash->old('display_title') == '0') { echo 'checked'; } ?>> No
                        </label>
                        </div>
                    </div>
                    <!-- /.form-group -->
                    
                    <div class="form-group">
                        <label>Display Type</label>
                        <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="display_type" value="megamenu" <?php if ($flash->old('display_type') == 'megamenu') { echo 'checked'; } ?>> Megamenu
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="display_type" value="dropdown" <?php if (!$flash->old('display_type') || $flash->old('display_type') == 'dropdown') { echo 'checked'; } ?>> Dropdown
                        </label>
                        </div>
                    </div>
                    <!-- /.form-group -->
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <label>Megamenu Options</label>
                            <p class="help-block"><small>These options only apply 1) when the 'Display Type' above is set to "megamenu" and 2) if this is a first-level menu item</small></p>
                        </div>
                        <div class="panel-body">
                        
                            <div class="form-group row">
                                <label class="col-md-2">Width</label>
                                <div class="col-md-2">
                                <select name="megamenu[width]" class="form-control">
                                    <option value="25" <?php if ($flash->old('megamenu.width') == 25 || is_null($flash->old('megamenu.width')) ) { echo "selected='selected'"; } ?>>25% of the entire menu</option>
                                    <option value="50" <?php if ($flash->old('megamenu.width') == 50) { echo "selected='selected'"; } ?>>50%</option>
                                    <option value="100" <?php if ($flash->old('megamenu.width') == 100) { echo "selected='selected'"; } ?>>100%</option>
                                </select>
                                <p class="help-block">This is the width of the <i>entire</i> Megamenu.  This option only applies to first-level menu items.
                                </div>
                            </div>
                            <!-- /.form-group -->
                        
                            <div class="form-group row">
                                <label class="col-md-2">Columns</label>
                                <div class="col-md-2">
                                <select name="megamenu[columns]" class="form-control">
                                    <option value="1" <?php if ($flash->old('megamenu.columns') == 1) { echo "selected='selected'"; } ?>>1</option>
                                    <option value="2" <?php if ($flash->old('megamenu.columns') == 2) { echo "selected='selected'"; } ?>>2</option>
                                    <option value="3" <?php if ($flash->old('megamenu.columns') == 3) { echo "selected='selected'"; } ?>>3</option>
                                    <option value="4" <?php if ($flash->old('megamenu.columns') == 4) { echo "selected='selected'"; } ?>>4</option>
                                    <option value="5" <?php if ($flash->old('megamenu.columns') == 5) { echo "selected='selected'"; } ?>>5</option>
                                    <option value="6" <?php if ($flash->old('megamenu.columns') == 6) { echo "selected='selected'"; } ?>>6</option>
                                </select>
                                </div>
                            </div>
                            <!-- /.form-group -->
                            
                            <div class="form-group row">
                                <label class="col-md-2">Group Child Items</label>
                                <div class="form-group col-md-10">
                                <label class="radio-inline">
                                    <input type="radio" name="megamenu[group_children]" value="1" <?php if (is_null($flash->old('megamenu.group_children')) || $flash->old('megamenu.group_children') == '1') { echo 'checked'; } ?>> Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="megamenu[group_children]" value="0" <?php if ($flash->old('megamenu.group_children') == '0') { echo 'checked'; } ?>> No
                                </label>
                                <p class="help-block">If set to YES, this item's children will be displayed in a grouped list with their children. 
                                </div>
                            </div>
                            <!-- /.form-group -->
                            
                        </div>
                    </div>
                    
                </div>
                
                <?php foreach ((array) $this->event->getArgument('content') as $key => $content ) { ?>
                <div class="tab-pane" id="tab-<?php echo $key; ?>">
                    <?php echo $content; ?>
                </div>
                <?php } ?>
            </div>

        </div>

    </div>
</form>