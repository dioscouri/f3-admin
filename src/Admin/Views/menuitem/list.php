<?php //echo \Dsc\Debug::dump( $state, false ); ?>
<?php //echo \Dsc\Debug::dump( $list ); ?>

<script>
Dsc.refreshParents = function() {
    var request = jQuery.ajax({
        type: 'get', 
        url: './admin/blog/categories/all'
    }).done(function(data){
        var lr = jQuery.parseJSON( JSON.stringify(data), false);
        if (lr.result) {
            jQuery('#parents').html(lr.result);
        }
    });
}
</script>

<div class="row">
    <div class="col-md-9">
        <form id="categories" class="searchForm" action="./admin/blog/categories" method="post">
        
            <?php echo $this->renderLayout('Blog/Admin/Views::categories/list_datatable.php'); ?>
        
        </form>
    </div>
    <div class="col-md-3">
    
    	<?php echo \Dsc\Request::internal( "\Blog\Admin\Controllers\Category->quickadd" ); ?>
		
    </div>
</div>