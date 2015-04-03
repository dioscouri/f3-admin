<div class="row">
    <div class="col-md-2">
    
        <h3>Default Status</h3>
        
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">

        <div class="form-group">
            <label>Is this the default language?</label>

            <select name="is_default" class="form-control">
                <option value="0" <?php if (!$flash->old('is_default')) { echo "selected='selected'"; } ?>>No</option>
                <option value="1" <?php if ($flash->old('is_default')) { echo "selected='selected'"; } ?>>Yes</option>
            </select>
        
        </div>
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->