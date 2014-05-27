<?php 
	$opts = array(
			array( 'value' => 1, 'text' => 'Yes' ),
			array( 'value' => 0, 'text' => 'No' ),
	);

?>
<div class="row">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-2">

                <h3>Kissmetrics</h3>

            </div>
            <!-- /.col-md-2 -->

            <div class="col-md-10">

                <div class="form-group">
                    <label>Enabled?</label>
                    <select name="integration[kissmetrics][enabled]" class="form-control">
                    	<?php  echo \Dsc\Html\Select::options( $opts, $flash->old('integration.kissmetrics.enabled') ); ?>
                    </select>
                
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label>API Key</label>
                    <input type="text" name="integration[kissmetrics][key]" placeholder="API Key" value="<?php echo $flash->old('integration.kissmetrics.key'); ?>" class="form-control" />
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col-md-10 -->

        </div>
        <!-- /.row -->

        <hr />
    </div>
</div>
