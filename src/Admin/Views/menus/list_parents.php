<script>
jQuery(document).ready(function(){
    jQuery('#selected-menu').change(function(){
        var val = jQuery(this).val();
        var url = '/admin/menus/' + val;
        window.location = url;         
    });
});
</script>

<?php if (!empty($roots)) { ?>
<select name="selected-menu" id="selected-menu" class="form-control">
<?php if (empty($selected)) { ?>
    <option>-Please select a menu-</option>
<?php } ?>    
<?php foreach ($roots as $one) { ?>
    <option value="<?php echo $one->id; ?>" <?php if ($one->_id == $selected) { echo "selected='selected'"; } ?>><?php echo $one->title; ?></option>                    
<?php } ?> 
</select>
<?php } ?>
