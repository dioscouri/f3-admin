<?php // echo \Dsc\Debug::dump( $flash->get('old'), false ); ?>

<form id="detail-form" action="./admin/blog/category/<?php echo $item->get( $model->getItemKey() ); ?>" class="form" method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <input type="text" name="title" placeholder="Title" value="<?php echo $flash->old('title'); ?>" class="form-control" />
            </div>
            <!-- /.form-group -->
            
            <div class="form-group">
                <?php echo $this->renderLayout('categories/list_parents.php'); ?>
            </div>
            <!-- /.form-group -->     
            
            <div class="form-actions">

                <div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <input id="primarySubmit" type="hidden" value="save_edit" name="submitType" />
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a onclick="document.getElementById('primarySubmit').value='save_new'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save & Create Another</a>
                            </li>
                            <li>
                                <a onclick="document.getElementById('primarySubmit').value='save_as'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save As</a>
                            </li>
                            <li>
                                <a onclick="document.getElementById('primarySubmit').value='save_close'; document.getElementById('detail-form').submit();" href="javascript:void(0);">Save & Close</a>
                            </li>
                        </ul>
                    </div>
                        
                    &nbsp;
                    <a class="btn btn-default" href="./admin/menus/<?php echo $item->tree; ?>">Cancel</a>
                </div>

            </div>
            <!-- /.form-group -->
    
        </div>
        
    </div>
</form>