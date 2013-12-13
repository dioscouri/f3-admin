<?php //echo \Dsc\Debug::dump( $state, false ); ?>

<div class="row">

    <div class="col-md-9 col-sm-6">

        <h2><?php echo !(empty($item->first_name)) ? $item->first_name : null; ?> <?php echo !(empty($item->last_name)) ? $item->last_name : null; ?></h2>
        <h3><?php echo $item->username; ?></h3>

        <hr />

        <p>
            <a href="./admin/user/edit/<?php echo $item->_id; ?>" class="btn btn-secondary">Edit</a>
        </p>

        <hr />

        <ul class="icons-list">
            <li>
                <i class="icon-li fa fa-envelope"></i>
                <?php echo $item->email; ?>
            </li>
            <?php if (!empty($item->website)) { ?>
            <li>
                <i class="icon-li fa fa-globe"></i>
                <?php echo $item->website; ?>
            </li>
            <?php } ?>
            <?php if (!empty($item->address)) { ?>
            <li>
                <i class="icon-li fa fa-map-marker"></i>
                City, ST
            </li>
            <?php } ?>
        </ul>

    </div>


    <div class="col-md-3 col-sm-6 col-sidebar-right">

        <h4>Quick Statistics</h4>


        <div class="list-group">

            <a href="javascript:;" class="list-group-item">
                <h3 class="pull-right">
                    <i class="fa fa-eye"></i>
                </h3>
                <h4 class="list-group-item-heading">38,847</h4>
                <p class="list-group-item-text">Profile Views</p>

            </a>

            <a href="javascript:;" class="list-group-item">
                <h3 class="pull-right">
                    <i class="fa fa-facebook-square"></i>
                </h3>
                <h4 class="list-group-item-heading">3,482</h4>
                <p class="list-group-item-text">Facebook Likes</p>

            </a>

            <a href="javascript:;" class="list-group-item">
                <h3 class="pull-right">
                    <i class="fa fa-twitter-square"></i>
                </h3>
                <h4 class="list-group-item-heading">5,845</h4>
                <p class="list-group-item-text">Twitter Followers</p>

            </a>
        </div>
        <!-- /.list-group -->

        <br />



        <div class="well">
            <h4>Recent Activity</h4>


            <ul class="icons-list text-md">

                <li>
                    <i class="icon-li fa fa-location-arrow"></i>

                    <strong>Last login</strong> <br /> <small>about 4 hours ago</small>
                </li>

            </ul>

        </div>
    </div>


</div>
<!-- /.row -->
