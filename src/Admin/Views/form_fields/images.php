<div class="clearfix">

<div class="col-md-8">

    <div class="portlet">

        <div class="portlet-header">

            <h3>Primary Image</h3>

        </div>
        <!-- /.portlet-header -->

        <div class="portlet-content">

            <?php echo \Assets\Admin\Controllers\Assets::instance()->fetchElementImage('primary_image', $flash->old('primary_image'), array('field'=>'primary_image') ); ?>
        
        </div>
        <!-- /.portlet-content -->

    </div>
    <!-- /.portlet -->    


    <?php foreach ((array) $flash->old('images') as $key=>$image) { ?>
        <fieldset class="template well clearfix">
            <a class="remove-image btn btn-xs btn-danger pull-right" onclick="RemoveRelatedImage(this);" href="javascript:void(0);">
                <i class="fa fa-times"></i>
            </a>                        
            <label>Image</label>
            <div class="form-group clearfix">
                <div class="col-md-12">
                    <?php echo \Assets\Admin\Controllers\Assets::instance()->fetchElementImage('image_' . $key, $flash->old('images.'.$key.'.image'), array('field'=>'images['.$key.'][image]') ); ?>
                </div>
            </div>
        </fieldset>                        
    <?php } ?>
</div>
<!-- /.col-md-8 -->

<div class="col-md-4 col-sidebar-right">

    <input type="hidden" name="images[][image]" value="" />

    <template type="text/template" id="add-image-template">
        <fieldset class="template well clearfix">
            <a class="remove-image btn btn-xs btn-danger pull-right" onclick="RemoveRelatedImage(this);" href="javascript:void(0);">
                <i class="fa fa-times"></i>
            </a>                        
            <label>New Image</label>
            <div class="form-group clearfix">
                <div class="col-md-12">
                    <?php echo \Assets\Admin\Controllers\Assets::instance()->fetchElementImage('image_{id}', null, array('field'=>'images[{id}][image]') ); ?>
                </div>
            </div>
        </fieldset>
    </template>
    
    <div class="form-group">
        <a class="btn btn-warning" id="add-image">Add New Image</a>
    </div>
    
    <div id="new-images" class="form-group"></div>
    
    <script>
    jQuery(document).ready(function(){
        window.new_images = <?php echo count( $flash->old('images') ); ?>;
        jQuery('#add-image').click(function(){
            var container = jQuery('#new-images');
            var template = jQuery('#add-image-template').html();
            template = template.replace( new RegExp("{id}", 'g'), window.new_images);
            container.append(template);
            window.new_images = window.new_images + 1;
            Dsc.setupColorbox();                            
        });

        RemoveRelatedImage = function(el) {
            jQuery(el).parents('.template').remove();                            
        }

    });
    </script>

</div>
<!-- /.col-md-4 -->

</div>