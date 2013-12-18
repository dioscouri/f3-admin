<?php if (!empty($categories)) { ?>
<label>Parent</label> 
<select name="parent" class="form-control">
    <option value="null">None</option>
<?php foreach ($categories as $one) { ?>
    <option value="<?php echo $one->_id; ?>" <?php if ($one->_id == $selected) { echo "selected='selected'"; } ?>><?php echo @str_repeat( "&ndash;", substr_count( @$one->path, "/" ) - 1 ) . " " . $one->title; ?></option>                    
<?php } ?> 
</select>
<?php } ?>                    
