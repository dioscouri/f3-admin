<div class="row">
    <div class="col-md-2">
    
        <h3>Enabled</h3>
        
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">

        <div class="form-group">
            <label>Status:</label>

            <select name="publication[status]" class="form-control">
                <option value="published" <?php if ($flash->old('publication.status') == 'published') { echo "selected='selected'"; } ?>>Published</option>
                <option value="unpublished" <?php if ($flash->old('publication.status') == 'unpublished') { echo "selected='selected'"; } ?>>Unpublished</option>
            </select>
        
        </div>
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->