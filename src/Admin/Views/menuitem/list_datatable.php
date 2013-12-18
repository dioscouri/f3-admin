<?php //echo \Dsc\Debug::dump( $state, false ); ?>
<?php //echo \Dsc\Debug::dump( $list ); ?>
        
<div class="row datatable-header">
    <div class="col-sm-6">
        <div class="row row-marginless">
            <?php if (!empty($list['subset'])) { ?>
            <div class="col-sm-4">
                <?php echo $pagination->getLimitBox( $state->get('list.limit') ); ?>
            </div>
            <?php } ?>
            <?php if (!empty($list['count']) && $list['count'] > 1) { ?>
            <div class="col-sm-8">
                <?php echo (!empty($list['count']) && $list['count'] > 1) ? $pagination->serve() : null; ?>
            </div>
            <?php } ?>
        </div>
    </div>    
    <div class="col-sm-6">
        <div class="input-group">
            <input class="form-control" type="text" name="filter[keyword]" placeholder="Keyword" maxlength="200" value="<?php echo $state->get('filter.keyword'); ?>"> 
            <span class="input-group-btn">
                <input class="btn btn-primary" type="submit" onclick="this.form.submit();" value="Search" />
                <button class="btn btn-danger" type="button" onclick="Dsc.resetFormFilters(this.form);">Reset</button>
            </span>
        </div>
    </div>
</div>

<input type="hidden" name="list[order]" value="<?php echo $state->get('list.order'); ?>" />
<input type="hidden" name="list[direction]" value="<?php echo $state->get('list.direction'); ?>" />

<div class="row table-actions">
    <div class="col-md-6 col-lg-4 input-group">
        <select id="bulk-actions" name="bulk_action" class="form-control">
            <option value="null">-Bulk Actions-</option>
            <option value="delete" data-action="./admin/blog/categories/delete">Delete</option>
        </select>
        <span class="input-group-btn">
            <button class="btn btn-default bulk-actions" type="button" data-target="bulk-actions">Apply</button>
        </span>
    </div>
</div>

<div class="table-responsive datatable">

<table class="table table-striped table-bordered table-hover table-highlight table-checkable">
	<thead>
		<tr>
		    <th class="checkbox-column"><input type="checkbox" class="icheck-input"></th>
			<th>Title</th>
			<th>Path</th>
			<th class="col-md-1"></th>
		</tr>
	</thead>
	<tbody>    

    <?php if (!empty($list['subset'])) { ?>

    <?php foreach ($list['subset'] as $item) { ?>
        <tr>
            <td class="checkbox-column">
                <input type="checkbox" class="icheck-input" name="ids[]" value="<?php echo $item->_id; ?>">
            </td>
            
            <td class="">
                <a href="./admin/blog/category/<?php echo $item->_id; ?>/edit">
                <?php echo @str_repeat( "&ndash;", substr_count( @$item->path, "/" ) - 1 ) . " " . $item->title; ?>
                </a>
            </td>
            
            <td class="">
                <a href="./admin/blog/category/<?php echo $item->_id; ?>/edit">
                <?php echo $item->path; ?>
                </a>
            </td>
                            
            <td class="text-center">
                <a class="btn btn-xs btn-secondary" href="./admin/blog/category/<?php echo $item->_id; ?>/edit">
                    <i class="fa fa-pencil"></i>
                </a>
                &nbsp;
                <a class="btn btn-xs btn-danger" data-bootbox="confirm" href="./admin/blog/category/<?php echo $item->_id; ?>/delete">
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

<div class="row datatable-footer">
    <?php if (!empty($list['count']) && $list['count'] > 1) { ?>
    <div class="col-sm-10">
        <?php echo (!empty($list['count']) && $list['count'] > 1) ? $pagination->serve() : null; ?>
    </div>
    <?php } ?>
    <div class="col-sm-2 pull-right">
        <div class="datatable-results-count pull-right">
        <?php echo $pagination ? $pagination->getResultsCounter() : null; ?>
        </div>
    </div>        
</div>
