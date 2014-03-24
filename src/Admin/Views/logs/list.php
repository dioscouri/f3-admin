<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i> 
				Logs 
			<span> > 
				List
			</span>
		</h1>
	</div>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

	</div>
</div>

<form class="searchForm" method="post">

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
                        <?php if (!empty($list['subset'])) { ?>
                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                            <?php echo (!empty($list['count']) && $list['count'] > 1) ? $pagination->serve() : null; ?>
                        </div>
                        <?php } ?>
                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                            <span class="pagination">
                            <?php echo $pagination->getLimitBox( $state->get('list.limit') ); ?>
                            </span>
                        </div>
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
                        <a href="./admin/log/edit/<?php echo $item->_id; ?>">
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
                        <a class="btn btn-xs btn-secondary" href="./admin/log/edit/<?php echo $item->_id; ?>">
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
        <!-- /.table-responsive .datatable .dt-wrapper -->
        
        <div class="dt-row dt-bottom-row">
            <div class="row">
                <div class="col-sm-10">
                    <?php echo (!empty($list['count']) && $list['count'] > 1) ? $pagination->serve() : null; ?>
                </div>
                <div class="col-sm-2">
                    <div class="datatable-results-count pull-right">
                        <span class="pagination">
                        <?php echo $pagination ? $pagination->getResultsCounter() : null; ?>
                        </span>
                    </div>
                </div>
            </div>                        
        </div>

    </div>
    <!-- /.no-padding --> 
    
</form>