<?php //echo \Dsc\Debug::dump( $state, false ); ?>

<form id="detail-form" action="./admin/user" class="form-horizontal" method="post">

    <div class="form-group">

        <label class="col-md-3">Username</label>

        <div class="col-md-7">
            <input type="text" name="username" value="<?php echo $item->username; ?>" class="form-control" />
        </div>
        <!-- /.col -->

    </div>
    <!-- /.form-group -->

    <div class="form-group">

        <label class="col-md-3">First Name</label>

        <div class="col-md-7">
            <input type="text" name="first_name" value="<?php echo $item->first_name; ?>" class="form-control" />
        </div>
        <!-- /.col -->

    </div>
    <!-- /.form-group -->

    <div class="form-group">

        <label class="col-md-3">Last Name</label>

        <div class="col-md-7">
            <input type="text" name="last_name" value="<?php echo $item->last_name; ?>" class="form-control" />
        </div>
        <!-- /.col -->

    </div>
    <!-- /.form-group -->

    <div class="form-group">

        <label class="col-md-3">Email Address</label>

        <div class="col-md-7">
            <input type="text" name="email" value="<?php echo $item->email; ?>" class="form-control" />
        </div>
        <!-- /.col -->

    </div>
    <!-- /.form-group -->

    <hr/>
    
    <div class="form-group form-actions">

        <div class="col-md-7 col-md-push-3">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            &nbsp;
            <a class="btn btn-default" href="./admin/users">Cancel</a>
        </div>
        <!-- /.col -->

    </div>
    <!-- /.form-group -->

</form>
