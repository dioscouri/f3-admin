<h3 class="">General Settings</h3>
<hr />

<div class="">

    <div class="form-group">
        <label>Global Page Title Suffix</label>
        <input name="system[page_title_suffix]" placeholder="| Your Site Name" value="<?php echo $flash->old('system.page_title_suffix'); ?>" class="form-control" type="text" />
    </div>
    
    <div class="form-group">
        <label>Force SSL?</label>
        
        <div class="input-group">
            <label class="radio-inline">
                <input type="radio" name="system[force_ssl]" value="0" <?php if ($flash->old('system.force_ssl') == 0) { echo "checked"; } ?>> No
            </label>
            <label class="radio-inline">
                <input type="radio" name="system[force_ssl]" value="1" <?php if ($flash->old('system.force_ssl') == 1) { echo "checked"; } ?>> Yes
            </label>
        </div>
    </div>
    <!-- /.form-group -->
        
</div>