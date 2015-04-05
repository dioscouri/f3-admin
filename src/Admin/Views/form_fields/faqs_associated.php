<div class="row">
    <div class="col-md-2">
        
        <h3>Associated FAQs</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Select a Faq Category</label>
            <p class="help-block">This category's FAQs will display as the last section on this Page.</p>
            <select class="form-control" name="faq[cat_id]">
                <option value="">None</option>
                <?php foreach (\Faq\Models\Categories::find(array('sort'=>array('title' => 1))) as $cat) {?>
                <option value="<?php echo $cat->id; ?>" <?php if ($flash->old('faq.cat_id') == $cat->id) { echo 'selected'; } ?>><?php echo $cat->title; ?></option>
                <?php } ?>
            </select>
        </div>
        <!-- /.form-group -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row -->