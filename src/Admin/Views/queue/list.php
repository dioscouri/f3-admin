<?php //echo \Dsc\Debug::dump( $state, false ); ?>
<?php //echo \Dsc\Debug::dump( $list ); ?>

<form id="list-form" action="./admin/queue" method="post">

    <div class="row datatable-header">
        <div class="col-sm-6">
            <div class="row">
                <?php if (!empty($list['subset'])) { ?>
                <div class="col-sm-2">
                    <?php echo $pagination->getLimitBox( $state->get('list.limit') ); ?>
                </div>
                <?php } ?>
                                
                <div class="col-sm-10">
                    <?php echo (!empty($list['count']) && $list['count'] > 1) ? $pagination->serve() : null; ?>
                </div>
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
    
    <table class="table table-striped table-bordered table-hover table-highlight">
		<thead>
			<tr>
                <th data-sortable="datetime">Datetime</th>
                <th data-sortable="priority">Priority</th>
                <th data-sortable="category">Category</th>
                <th data-sortable="message">Message</th>
                <th></th>
            </tr>
		</thead>
		<tbody>    
        
        <?php if (!empty($list['subset'])) { ?>
    
            <?php foreach ($list['subset'] as $item) { ?>
                <tr>
                    <td class="">
                        <a href="./admin/queueitem/<?php echo $item->_id; ?>">
                            <?php echo $item->datetime; ?>
                        </a>
                    </td>
                    <td class="">
                        <?php echo $item->priority; ?>
                    </td>
                    <td class="">
                        <?php echo $item->category; ?>
                    </td>
                    <td class="">
                        <?php echo $item->message; ?>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-xs btn-secondary" href="./admin/queueitem/edit/<?php echo $item->_id; ?>">
                            <i class="fa fa-pencil"></i>
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
        <div class="col-sm-10">
            <?php echo (!empty($list['count']) && $list['count'] > 1) ? $pagination->serve() : null; ?>
        </div>
        <div class="col-sm-2">
            <div class="datatable-results-count pull-right">
            <?php echo $pagination ? $pagination->getResultsCounter() : null; ?>
            </div>
        </div>        
    </div>    
    
</form>