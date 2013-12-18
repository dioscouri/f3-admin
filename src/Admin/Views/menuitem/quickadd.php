<div class="portlet">

    <div class="portlet-header">

        <h3>Add New Category</h3>

    </div>
    <!-- /.portlet-header -->

    <div class="portlet-content">
        <div id="quick-form-response-container"></div>

        <form id="quick-form" action="./admin/blog/category" class="form dsc-ajax-form" method="post"
            data-callback="Dsc.refreshParents" data-message_container="quick-form-response-container" data-refresh_list="true"
            data-list_container="categories"
        >

            <div class="form-group">
                <input type="text" name="title" placeholder="Title" class="form-control" />
            </div>
            <!-- /.form-group -->

            <div id="parents" class="form-group">
                <?php echo $this->renderLayout('Blog/Admin/Views::categories/list_parents.php'); ?>                    
            </div>
            <!-- /.form-group -->

            <hr />

            <div class="form-actions">

                <div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>

            </div>
            <!-- /.form-group -->
        </form>

    </div>
    <!-- /.portlet-content -->

</div>
<!-- /.portlet -->