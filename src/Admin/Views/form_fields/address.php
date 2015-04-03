<div class="row">
    <div class="col-md-2">
        
        <h3>Address</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Line 1</label>
            <input type="text" name="address[line_1]" placeholder="Line 1" value="<?php echo $flash->old('address.line_1'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            <label>Line 2</label>
            <input type="text" name="address[line_2]" placeholder="Line 2" value="<?php echo $flash->old('address.line_2'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
        
        <div class="form-group">
            <label>City</label>
            <input type="text" name="address[city]" placeholder="e.g. New York" value="<?php echo $flash->old('address.city'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
            
        <div class="form-group">
            <label>State/Region</label>
            <input type="text" name="address[region]" placeholder="e.g. Alabama or Virginia" value="<?php echo $flash->old('address.region'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
        
        <div class="form-group">
            <label>Country</label>
            <input type="text" name="address[country]" placeholder="e.g. US or UK" value="<?php echo $flash->old('address.country'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
        
        <div class="form-group">
            <label>Postal Code</label>
            <input type="text" name="address[postal_code]" placeholder="10133" value="<?php echo $flash->old('address.postal_code'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
        
        <div class="form-group">
            <label>Latitude</label>
            <input type="text" name="address[latitude]" placeholder="e.g. 37.8789756" value="<?php echo $flash->old('address.latitude'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
        
        <div class="form-group">
            <label>Longitude</label>
            <input type="text" name="address[longitude]" placeholder="e.g. -122.405112312" value="<?php echo $flash->old('address.longitude'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row --> 