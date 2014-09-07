<div class="row">
    <div class="col-md-2">
        
        <h3>Command</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Enter either a valid CLI command to run on the system with the current users permissions, or reference an external script for execution.</label>
            <textarea class="form-control" name="command" rows="5"><?php echo $flash->old('command'); ?></textarea>
        </div>
        <!-- /.form-group -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row -->

<hr/>

<div class="row">
    <div class="col-md-2">
        
        <h3>Status</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Active?</label>
            <select name="active" class="form-control">
                <option value="0" <?php if (!$flash->old('active')) { echo "selected='selected'"; } ?>>No</option>
                <option value="1" <?php if ($flash->old('active')) { echo "selected='selected'"; } ?>>Yes</option>
            </select>
        </div>
        <!-- /.form-group -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row -->

<hr/>

<div class="row">
    <div class="col-md-2">
        
        <h3>When to Execute</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Minutes</label>
            <input type="text" name="minute" placeholder="Minutes" value="<?php echo $flash->old('minute'); ?>" class="form-control" />
            <p class="help-block">Enter a CSV of valid values, or * for every minute.  Do not put any spaces between values and commas.  Shortcuts such as */15 (for every fifteen minutes) are also acceptable.</p>
        </div>
        <!-- /.form-group -->
        
        <div class="form-group">
            <label>Hours</label>
            <input type="text" name="hour" placeholder="Hours" value="<?php echo $flash->old('hour'); ?>" class="form-control" />
            <p class="help-block">Enter a CSV of valid values, or * for every hour.  Do not put any spaces between values and commas.</p>
        </div>
        <!-- /.form-group -->
        
        <div class="form-group">
            <label>Days of the Month</label>
            <input type="text" name="dayOfMonth" placeholder="Days" value="<?php echo $flash->old('dayOfMonth'); ?>" class="form-control" />
            <p class="help-block">Enter a CSV of valid values, or * for every day of the month.  Do not put any spaces between values and commas.</p>
        </div>
        <!-- /.form-group -->
        
        <div class="form-group">
            <label>Months</label>
            <input type="text" name="month" placeholder="Months" value="<?php echo $flash->old('month'); ?>" class="form-control" />
            <p class="help-block">Enter a CSV of valid values, or * for every month.  Do not put any spaces between values and commas.</p>
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <label>Days of the Week</label>
            <input type="text" name="dayOfWeek" placeholder="Weekdays" value="<?php echo $flash->old('dayOfWeek'); ?>" class="form-control" />
            <p class="help-block">Enter a CSV of valid values, or * for every day of the week.  Do not put any spaces between values and commas.</p>
            <ul class="help-block list-unstyled">
                <li>0=Sunday</li>
                <li>1=Monday</li>
                <li>2=Tuesday</li>
                <li>3=Wednesday</li>
                <li>4=Thursday</li>
                <li>5=Friday</li>
                <li>6=Saturday</li>
            </ul>
        </div>
        <!-- /.form-group -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row -->