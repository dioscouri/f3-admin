<style>
.publication .label {
cursor:pointer;
}
.publication .label-success:before {
content: "Published";
}
.publication .label-default:before {
content: "Undefined";
}
.publication .label-secondary:before, .publication .label-danger:before {
content: "UnPublished";
}
</style>


<div class="no-padding">

<div class="row">
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <?php /* ?>
        <ul class="list-filters list-unstyled list-inline">
            <li>
                <a class="btn btn-link">Advanced Filtering</a>
            </li>                
            <li>
                <a class="btn btn-link">Quicklink Filter</a>
            </li>
            <li>
                <a class="btn btn-link">Quicklink Filter</a>
            </li>                    
        </ul>    
        */ ?>        
    </div>
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <div class="form-group">
            <div class="input-group">
                <input class="form-control" type="text" name="filter[keyword]" placeholder="Search..." maxlength="200" value="<?php echo $state->get('filter.keyword'); ?>"> 
                <span class="input-group-btn">
                    <input class="btn btn-primary" type="submit" onclick="this.form.submit();" value="Search" />
                    <button class="btn btn-danger" type="button" onclick="Dsc.resetFormFilters(this.form);">Reset</button>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="widget-body-toolbar">
    <div class="row">
        <div class="col-xs-12 col-sm-5 col-md-3 col-lg-3">
            <span class="pagination"></span>
        </div>    
        <div class="col-xs-12 col-sm-7 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
            <div class="row text-align-right">
                <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                <?php if (!empty($paginated->total_pages) && $paginated->total_pages > 1) { ?>
                    <?php echo $paginated->serve(); ?>
                <?php } ?>
                </div>
                <?php if (!empty($paginated->items)) { ?>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <span class="pagination">
                    <?php echo $paginated->getLimitBox( $state->get('list.limit') ); ?>
                    </span>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /.widget-body-toolbar -->

<input type="hidden" name="list[order]" value="<?php echo $state->get('list.order'); ?>" />
<input type="hidden" name="list[direction]" value="<?php echo $state->get('list.direction'); ?>" />

<div class="table-responsive datatable dt-wrapper dataTables_wrapper">
        
    <table class="table table-striped table-bordered table-hover table-highlight table-checkable">
	<thead>
		<tr>
		    <th class="checkbox-column"><input type="checkbox" class="icheck-input"></th>
			<th>Title + Path</th>
			<th>URL</th>
			<th class="text-center">Published</th>
			<th class="text-center">Ordering</th>			
			<th class="col-md-1"></th>
		</tr>
	</thead>
	<tbody>    

    <?php if (!empty($paginated->items)) { ?>
            
        <?php foreach($paginated->items as $item) { ?>
        <tr data-id="<?php echo $item->_id; ?>">
            <td class="checkbox-column">
                <input type="checkbox" class="icheck-input" name="ids[]" value="<?php echo $item->_id; ?>">
            </td>
            
            <td class="">
                <ul class="list-unstyled list-inline">
                    <?php if ((substr_count( $item->path, "/" ) - 2) > 0) { ?>
                    <li>
                        <?php echo str_repeat( "<small><span class='text-muted'>|&mdash;</span></small>", substr_count( $item->path, "/" ) - 2 ); ?>
                        <p class="help-block">&nbsp;</p>                        
                    </li>
                    <?php } ?>
                    <li>
                        <a href="./admin/menu/edit/<?php echo $item->_id; ?>">
                        <?php echo $item->title; ?>
                        </a>
                        <p class="help-block">
                        <?php echo $item->path; ?>
                        </p>
                    </li>
                </ul>
            </td>
            
            <td class="">
                <a href="./admin/menu/edit/<?php echo $item->_id; ?>">
                <?php echo $item->{'details.url'}; ?>
                </a>
            </td>
            
            <td class="text-center publication">
                <?php if (!isset($item->published)) { ?>
                <span class="label label-default"> </span>
                <?php } elseif ($item->published) { ?>
                <span class="label label-success"> </span>
                <?php } else { ?>
                <span class="label label-secondary"> </span>
                <?php } ?>
            </td>
            
            <td class="text-center">
                <a class="btn btn-xs btn-tertiary" href="./admin/menu/moveup/<?php echo $item->id; ?>">
                    <i class="fa fa-chevron-up"></i>
                </a>
                &nbsp;
                <a class="btn btn-xs btn-tertiary" href="./admin/menu/movedown/<?php echo $item->id; ?>">
                    <i class="fa fa-chevron-down"></i>
                </a>
            </td>
                            
            <td class="text-center">
                <a class="btn btn-xs btn-secondary" href="./admin/menu/edit/<?php echo $item->_id; ?>">
                    <i class="fa fa-pencil"></i>
                </a>
                &nbsp;
                <a class="btn btn-xs btn-danger" data-bootbox="confirm" href="./admin/menu/delete/<?php echo $item->_id; ?>">
                    <i class="fa fa-times"></i>
                </a>
            </td>
        </tr>
    <?php } ?>
    
    <?php } else { ?>
        <tr>
        <td colspan="100">
            <div class="">No items found.</div>
        </td>
        </tr>
    <?php } ?>

    </tbody>
    </table>

</div>

<div class="dt-row dt-bottom-row">
    <div class="row">
        <div class="col-sm-10">
            <?php if (!empty($paginated->total_pages) && $paginated->total_pages > 1) { ?>
                <?php echo $paginated->serve(); ?>
            <?php } ?>
        </div>
        <div class="col-sm-2">
            <div class="datatable-results-count pull-right">
                <span class="pagination">
                    <?php echo (!empty($paginated->total_pages)) ? $paginated->getResultsCounter() : null; ?>
                </span>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.no-padding --> 
<!--  SNIPPET FOR PUBLISH UNPUBLISH --> 
<script type="text/javascript">

jQuery(document).ready(function(){
	jQuery('.publication span.label').click(function(){
		id = jQuery(this).closest('tr').data('id');
		url = 	'/admin/menu/publishtoggle/' + id;
		el = jQuery(this);
		$.post( url, function( data ) {
			el.removeClass().addClass('label ' + data.result);
			});
		});
});
</script>

