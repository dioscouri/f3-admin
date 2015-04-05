<p class="help-block">
    Add an unlimited number of content blocks to this Page.  When you click save, the content blocks will automatically merge to form the correctly-formatted content for this Page, which you can then view under the "Basics" tab.
</p>

<hr/>

<div class="row">
    <div class="col-md-2">
        
        <p><a class="btn btn-warning" id="add-content-block">Add New Block</a></p>
        <input type="hidden" name="content_blocks[]" value="" />

        <template type="text/template" id="add-content-block-template">
            <fieldset class="template well clearfix">
                <a class="remove-content-block btn btn-xs btn-danger pull-right" onclick="RemoveContentBlock(this);" href="javascript:void(0);">
                    <i class="fa fa-times"></i>
                </a>                        
                <h3>New Content Block</h3>
                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label>Layout</label>
                            <select name="content_blocks[{id}][layout]" class="form-control layout_select">
                                <option value="1-column" data-copy_blocks="1">1-column</option>
                                <option value="2-column" data-copy_blocks="2">2-column</option>
                                <option value="3-column" data-copy_blocks="3">3-column</option>
                                <option value="3-column-diamonds" data-copy_blocks="3">3-column w/diamonds</option>
                                <option value="quote" data-copy_blocks="1">Quote</option>
                                <option value="quote-diamonds" data-copy_blocks="1">Quote w/diamonds</option>
                            </select>                            
                        </div>
                        <!-- /.form-group -->
                                
                    </div>
                    <!-- /.col-md-2 -->
                                
                    <div class="col-md-6">
                    
                        <div class="form-group">
                            <label>CSS Classes</label>
                            <input type="text" name="content_blocks[{id}][class]" placeholder="Space-separated strings" class="form-control" />
                        </div>
                        <!-- /.form-group -->
                            
                    </div>
                    <!-- /.col-md-10 -->
                    
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" name="content_blocks[{id}][heading]" placeholder="Add a Heading" class="form-control" />
                            <p class="help-block">Headings are ignored in the Quote layout</p>
                        </div>
                        <!-- /.form-group -->
                                
                    </div>
                    <!-- /.col-md-2 -->
                    
                </div>
                <!-- /.row -->
                
                <div class="row copy copy_1">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label>Copy 1</label>
                            <textarea name="content_blocks[{id}][copy][0]" class="form-control wysiwyg tpl_wysiwyg_{id}" rows="10"></textarea>
                        </div>
                        <!-- /.form-group -->
                                
                    </div>
                    <!-- /.col-md-2 -->
                </div>
                <!-- /.row -->
                
                <div class="row copy copy_2" style="display: none;">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label>Copy 2</label>
                            <textarea name="content_blocks[{id}][copy][1]" class="form-control wysiwyg tpl_wysiwyg_{id}" rows="10"></textarea>
                        </div>
                        <!-- /.form-group -->
                                
                    </div>
                    <!-- /.col-md-2 -->
                </div>
                <!-- /.row -->
                
                <div class="row copy copy_3" style="display: none;">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label>Copy 3</label>
                            <textarea name="content_blocks[{id}][copy][2]" class="form-control wysiwyg tpl_wysiwyg_{id}" rows="10"></textarea>
                        </div>
                        <!-- /.form-group -->
                                
                    </div>
                    <!-- /.col-md-2 -->
                </div>
                <!-- /.row -->
                
            </fieldset>
        </template>
        
        <script>
        jQuery(document).ready(function(){
            window.new_content_blocks = <?php echo count( $flash->old('content_blocks') ); ?>;
            jQuery('#add-content-block').click(function(){
                var container = jQuery('#new-content-blocks');
                var template = jQuery('#add-content-block-template').html();
                template = template.replace( new RegExp("{id}", 'g'), window.new_content_blocks);
                container.append(template);
                Dsc.setupColorbox();
                FundingSetupLayoutSelects();     
                CKEDITOR.replaceAll( 'tpl_wysiwyg_'+window.new_content_blocks );                
                window.new_content_blocks = window.new_content_blocks + 1;
            });
    
            RemoveContentBlock = function(el) {
                jQuery(el).parents('.template').remove();                            
            }

            $('fieldset.template').each(function(){
               var el = $(this);
               var selected = el.find('.layout_select :selected');
               var copy_blocks = parseInt(selected.attr('data-copy_blocks'));

               if (copy_blocks == 1) {
                   el.find('.row.copy.copy_2').hide();
                   el.find('.row.copy.copy_3').hide();                    
               } else if (copy_blocks == 2) {
                   el.find('.row.copy.copy_2').show();                    
                   el.find('.row.copy.copy_3').hide();
               } else if (copy_blocks == 3) {
                   el.find('.row.copy.copy_2').show();
                   el.find('.row.copy.copy_3').show(); 
               }
            });
            
            FundingSetupLayoutSelects();
        });

        FundingSetupLayoutSelects = function() {
            var els = $('.layout_select');
            els.off("change.layout_select");  
            els.on("change.layout_select", function(ev){
                console.log('changed');
                var el = jQuery(this);
                var selected = el.find(':selected');
                var copy_blocks = parseInt(selected.attr('data-copy_blocks'));
                var parent = el.parents('.template');
                
                if (copy_blocks == 1) {
                    parent.find('.row.copy.copy_2').hide();
                    parent.find('.row.copy.copy_3').hide();                    
                } else if (copy_blocks == 2) {
                    parent.find('.row.copy.copy_2').show();                    
                    parent.find('.row.copy.copy_3').hide();
                } else if (copy_blocks == 3) {
                    parent.find('.row.copy.copy_2').show();
                    parent.find('.row.copy.copy_3').show(); 
                }
            });
        };
        </script>
        
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <?php foreach ((array) $flash->old('content_blocks') as $key=>$content_block) { ?>
            <fieldset class="template well clearfix">
                <a class="remove-content-block btn btn-xs btn-danger pull-right" onclick="RemoveContentBlock(this);" href="javascript:void(0);">
                    <i class="fa fa-times"></i>
                </a>                        
                <h3>Content Block <?php echo $key+1; ?></h3>

                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label>Layout</label>
                            <select name="content_blocks[<?php echo $key; ?>][layout]" class="form-control layout_select">
                                <option value="1-column" <?php if ($flash->old('content_blocks.'.$key.'.layout') == "1-column") { echo "selected"; } ?> data-copy_blocks="1">1-column</option>
                                <option value="2-column" <?php if ($flash->old('content_blocks.'.$key.'.layout') == "2-column") { echo "selected"; } ?> data-copy_blocks="2">2-column</option>
                                <option value="3-column" <?php if ($flash->old('content_blocks.'.$key.'.layout') == "3-column") { echo "selected"; } ?> data-copy_blocks="3">3-column</option>
                                <option value="3-column-diamonds" <?php if ($flash->old('content_blocks.'.$key.'.layout') == "3-column-diamonds") { echo "selected"; } ?> data-copy_blocks="3">3-column w/diamonds</option>
                                <option value="quote" <?php if ($flash->old('content_blocks.'.$key.'.layout') == "quote") { echo "selected"; } ?> data-copy_blocks="1">Quote</option>
                                <option value="quote-diamonds" <?php if ($flash->old('content_blocks.'.$key.'.layout') == "quote-diamonds") { echo "selected"; } ?> data-copy_blocks="1">Quote w/diamonds</option>
                            </select>
                        </div>
                        <!-- /.form-group -->
                                
                    </div>
                    <!-- /.col-md-2 -->
                                
                    <div class="col-md-6">
                    
                        <div class="form-group">
                            <label>CSS Classes</label>
                            <input type="text" name="content_blocks[<?php echo $key; ?>][class]" placeholder="Space-separated strings" value="<?php echo $flash->old('content_blocks.'.$key.'.class'); ?>" class="form-control" />
                        </div>
                        <!-- /.form-group -->
                            
                    </div>
                    <!-- /.col-md-10 -->
                    
                </div>
                <!-- /.row --> 
                
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" name="content_blocks[<?php echo $key; ?>][heading]" placeholder="Add a Heading" value="<?php echo $flash->old('content_blocks.'.$key.'.heading'); ?>" class="form-control" />
                            <p class="help-block">Headings are ignored in the Quote layout</p>
                        </div>
                        <!-- /.form-group -->
                                
                    </div>
                    <!-- /.col-md-2 -->
                    
                </div>
                <!-- /.row -->
                
                <div class="row copy copy_1">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label>Copy 1</label>
                            <textarea name="content_blocks[<?php echo $key; ?>][copy][0]" class="form-control wysiwyg" rows="10"><?php echo $flash->old('content_blocks.'.$key.'.copy.0'); ?></textarea>
                        </div>
                        <!-- /.form-group -->
                                
                    </div>
                    <!-- /.col-md-2 -->
                </div>
                <!-- /.row -->
                
                <div class="row copy copy_2" style="display: none;">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label>Copy 2</label>
                            <textarea name="content_blocks[<?php echo $key; ?>][copy][1]" class="form-control wysiwyg" rows="10"><?php echo $flash->old('content_blocks.'.$key.'.copy.1'); ?></textarea>
                        </div>
                        <!-- /.form-group -->
                                
                    </div>
                    <!-- /.col-md-2 -->
                </div>
                <!-- /.row -->
                
                <div class="row copy copy_3" style="display: none;">
                    <div class="col-md-12">
                        
                        <div class="form-group">
                            <label>Copy 3</label>
                            <textarea name="content_blocks[<?php echo $key; ?>][copy][2]" class="form-control wysiwyg" rows="10"><?php echo $flash->old('content_blocks.'.$key.'.copy.2'); ?></textarea>
                        </div>
                        <!-- /.form-group -->
                                
                    </div>
                    <!-- /.col-md-2 -->
                </div>
                <!-- /.row -->
                
            </fieldset>                        
        <?php } ?>
        
        <div id="new-content-blocks" class="clearfix form-group"></div>
            
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row --> 