<div class="row">
    <div class="col-md-2">
        
        <h3>Venue</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Select a Venue</label>
            <?php echo \Fountain\Admin\Controllers\Venues::instance()->fetchElement('venue_id', $flash->old('venue_id'), array('field'=>'venue_id') ); ?>
        </div>
        <!-- /.form-group -->

    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row --> 