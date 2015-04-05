<div class="row">
    <div class="col-md-2">
    
        <h3>Publication</h3>
        
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">

        <div class="form-group">
            <label>Status:</label>

            <select name="publication[status]" class="form-control">
                <option value="draft" <?php if ($flash->old('publication.status') == 'draft') { echo "selected='selected'"; } ?>>Draft</option>
                <option value="pending" <?php if ($flash->old('publication.status') == 'pending') { echo "selected='selected'"; } ?>>Pending Review</option>
                <option value="published" <?php if ($flash->old('publication.status') == 'published') { echo "selected='selected'"; } ?>>Published</option>
                <option value="unpublished" <?php if ($flash->old('publication.status') == 'unpublished') { echo "selected='selected'"; } ?>>Unpublished</option>
            </select>
        
        </div>
        <div class="form-group">
            <label>Start:</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="publication[start_date]" value="<?php echo $flash->old('publication.start_date', date('Y-m-d') ); ?>" class="ui-datepicker form-control" type="text" data-date-format="yyyy-mm-dd" data-date-today-highlight="true" data-date-today-btn="true">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>                    
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="publication[start_time]" value="<?php echo $flash->old('publication.start_time' ); ?>" type="text" class="ui-timepicker form-control" data-show-meridian="false" data-show-inputs="false">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Finish:</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="publication[end_date]" value="<?php echo $flash->old('publication.end_date' ); ?>" class="ui-datepicker form-control" type="text" data-date-format="yyyy-mm-dd" data-date-today-highlight="true" data-date-today-btn="true">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>                        
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="publication[end_time]" value="<?php echo $flash->old('publication.end_time' ); ?>" type="text" class="ui-timepicker form-control" data-default-time="false" data-show-meridian="false" data-show-inputs="false">
                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                    </div>
                </div>
            </div>
            <span class="help-text">Leave these blank to never unpublish.</span>
        </div>
        <!-- /.form-group -->
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->