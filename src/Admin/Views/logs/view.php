<div class="well">
        
    <div class="clearfix">

        <div class="pull-right">
            <a class="btn btn-default" href="./admin/logs">Close</a>
        </div>

    </div>
    
    <hr />
    <!-- /.form-actions -->
    
    <?php if (!empty($item)) { ?>
        <div class="row">
            <div class="col-md-2">
                
                <h3>Basics</h3>
                        
            </div>
            <!-- /.col-md-2 -->
                        
            <div class="col-md-10">
            
                <div class="form-group">
                    <label>Created</label>
                    <div class="well well-sm"><?php echo date('Y-m-d H:i:s', $item->{'created.time'} ); ?></div>
                </div>
                <!-- /.form-group -->            
            
                <div class="form-group">
                    <label>Priority</label>
                    <div class="well well-sm"><?php echo $item->priority; ?></div>
                </div>
                <!-- /.form-group -->
                
                <div class="form-group">
                    <label>Category</label>
                    <div class="well well-sm"><?php echo $item->category; ?></div>
                </div>
                <!-- /.form-group -->
                
            </div>
            <!-- /.col-md-10 -->
            
        </div>
        <!-- /.row -->
        
        <hr />    
            
        <div class="row">
            <div class="col-md-2">
                
                <h3>Message</h3>
                        
            </div>
            <!-- /.col-md-2 -->
                        
            <div class="col-md-10">
            
                <div class="form-group">
                    <?php echo $item->message; ?>
                </div>
                <!-- /.form-group -->
                
            </div>
            <!-- /.col-md-10 -->
            
        </div>
        <!-- /.row -->

    <?php } ?>
    
</div>