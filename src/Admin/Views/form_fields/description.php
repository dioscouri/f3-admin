<script>
jQuery(document).ready(function(){
    CKEDITOR.replaceAll( 'wysiwyg' );    
});
</script>

<div class="row">
    <div class="col-md-2">
        
        <h3>Description</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Complete Description</label>
            <textarea name="description" class="form-control wysiwyg" rows="10"><?php echo $flash->old('description'); ?></textarea>
        </div>
        <!-- /.form-group -->
            
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row --> 