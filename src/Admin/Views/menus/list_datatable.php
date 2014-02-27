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

<div class="table-responsive datatable">

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

    <?php if (!empty($list['subset'])) { ?>

    <?php foreach ($list['subset'] as $item) { ?>
        <tr>
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
            
            <td class="text-center">
                <?php if (!isset($item->published)) { ?>
                <span class="label label-default">Undefined</span>
                <?php } elseif ($item->published) { ?>
                <span class="label label-success">Published</span>
                <?php } else { ?>
                <span class="label label-secondary">Unpublished</span>
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
