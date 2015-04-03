<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-table fa-fw "></i> 
				Translations 
			<span> > 
				Languages
			</span>
		</h1>
	</div>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="list-actions list-unstyled list-inline">
            <li>
                <a class="btn btn-success" href="./admin/language/create">Add New</a>
            </li>
        </ul>            	
	</div>
</div>

<form class="searchForm" method="post" action="./admin/languages">

    <input type="hidden" name="list[order]" value="<?php echo $state->get('list.order'); ?>" />
    <input type="hidden" name="list[direction]" value="<?php echo $state->get('list.direction'); ?>" />
        
    <div class="row">
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
            <ul class="list-filters list-unstyled list-inline">
                <li>
                    <?php /* ?><a class="btn btn-link" href="javascript:void(0);" onclick="ToggleAdvancedFilters();">Advanced Filters</a> */ ?>
                </li>
                <li>
					<select name="filter[publication_status]" class="form-control" onchange="this.form.submit();">
                        <?php 
                        	echo \Dsc\Html\Select::options(array(
                                array('text'=>'All Statuses', 'value'=>''),
                                array('text'=>'Published', 'value'=>'published'),
                                array('text'=>'Unpublished', 'value'=>'unpublished'),
                            ), $state->get('filter.publication_status'));
                        ?>                    			
					</select>
                </li>                
            </ul>        
        </div>
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <div class="form-group">
                <div class="input-group">
                    <input class="form-control" type="text" name="filter[keyword]" placeholder="Search..." maxlength="200" value="<?php echo $state->get('filter.keyword'); ?>"> 
                    <span class="input-group-btn">
                        <input class="btn btn-primary" type="submit" onclick="this.form.submit();" value="Search" />
                        <button class="btn btn-danger" type="button" onclick="Dsc.resetFormFilters(this.form);">Reset Filters</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div id="advanced-filters" class="panel panel-default" 
    <?php 
    if (!$state->get('filter.last_modified_after')
        && !$state->get('filter.last_modified_before')            
    ) { ?>
        style="display: none;"
    <?php } ?>
    >
        <div class="panel-body">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-2">
                            <h4>Last Modified</h4>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" name="filter[last_modified_after]" value="<?php echo $state->get('filter.last_modified_after'); ?>" class="input-sm ui-datepicker form-control" data-date-format="yyyy-mm-dd" data-date-today-highlight="true" data-date-today-btn="true" />
                                    <span class="input-group-addon">to</span>
                                    <input type="text" name="filter[last_modified_before]" value="<?php echo $state->get('filter.last_modified_before'); ?>" class="input-sm ui-datepicker form-control" data-date-format="yyyy-mm-dd" data-date-today-highlight="true" data-date-today-btn="true" />
                                </div>
                            </div>
                        </div>                
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary pull-right">Go</button>
                </div>
            </div>   
        </div> 
    </div>
    
    <script>
    ToggleAdvancedFilters = function(el) {
        var filters = jQuery('#advanced-filters');
        if (filters.is(':hidden')) {
            filters.slideDown();        
        } else {
        	filters.slideUp();
        }
    }
    </script>        
    
    <?php if (!empty($paginated->items)) { ?>
    <div class="panel panel-default">
        <div class="panel-heading">

            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                    <span class="pagination">
                        <div class="input-group">
                            <select id="bulk-actions" name="bulk_action" class="form-control">
                                <option value="null">-Bulk Actions-</option>
                                <option value="delete" data-action="./admin/languages/delete">Delete</option>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-default bulk-actions" type="button" data-target="bulk-actions">Apply</button>
                            </span>
                        </div>
                    </span>
                </div>
                  
                <div class="col-xs-8 col-sm-5 col-md-5 col-lg-6">
                    <?php if (!empty($paginated->total_pages) && $paginated->total_pages > 1) { ?>
                        <?php echo $paginated->serve(); ?>
                    <?php } ?>            
                </div>
                
                <?php if (!empty($paginated->items)) { ?>
                <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3 text-align-right">
                    <span class="pagination">
                        <span class="hidden-xs hidden-sm">
                            <?php echo $paginated->getResultsCounter(); ?>
                        </span>
                    </span>
                    <span class="pagination">
                        <?php echo $paginated->getLimitBox( $state->get('list.limit') ); ?>
                    </span>                                        
                </div>
                <?php } ?>        
                
            </div>            
            
        </div>
        <div class="panel-body">
            <div class="list-group-item">
                <div class="row">
                    <div class="col-xs-2 col-md-1">
                        <input type="checkbox" class="icheck-toggle icheck-input" data-target="icheck-id">
                    </div>
                    <div class="col-xs-10 col-md-11">
                        Sort by:
                        <a class="btn btn-link" data-sortable="ordering">Manual Ordering</a>
                        <a class="btn btn-link" data-sortable="title">Title</a>
                    </div>
                </div>
            </div>        

            <?php $publishStates = array(array('value' => 'unpublished', 'text' => 'unpublished'), array('value' => 'published', 'text' => 'published')) ; ?>
            
            <?php foreach($paginated->items as $item) { ?>
                
            <?php $xEditable = new \Dsc\Html\xEditable($item, '/admin/language/edit/inline'); ?>                      
            <div class="list-group-item">        
                <div class="row">
                    <div class="checkbox-column col-xs-1 col-sm-1 col-md-1">
                        <input type="checkbox" class="icheck-input icheck-id" name="ids[]" value="<?php echo $item->id; ?>">
                    </div>
                                                
                    <div class="col-xs-11 col-sm-11 col-md-11">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <h5>
                                    <a href="./admin/language/edit/<?php echo $item->id; ?>">
                                    <?php echo $item->title; ?>
                                    </a>
                                </h5>
                    			<?php $categories = \Joomla\Utilities\ArrayHelper::getColumn( (array) $item->categories, 'title' ); ?>
                    			<?php if ($categories) { ?>
                    			<div>			                        			
                    				<label>Categories:</label>
									<span class='label label-warning'><?php echo implode("</span> <span class='label label-warning'>", (array) $categories ); ?></span>
                    			</div>
                    			<?php } ?>
                    			<hr class="visible-sm visible-xs" />                                
                            </div>
	                    	<div class="col-xs-4 col-sm-4 col-md-2">
                        		<a class="btn btn-xs" href="./admin/languages/moveUp/<?php echo $item->id; ?>" title="Move Up">
                        			<i class="fa fa-chevron-up"></i>
                        		</a>
                        		&nbsp;
                        		<a class="btn btn-xs" href="./admin/languages/moveDown/<?php echo $item->id; ?>" title="Move Down">
                        			<i class="fa fa-chevron-down"></i>
                        		</a>
                                <div>
                                    <label>Order: </label>
                                    <?php echo $xEditable->field( 'ordering' ); ?>
                                </div>                        		
	                    	</div>	                            
	                        <div class="col-xs-4 col-sm-4 col-md-2">
                                <h5 class="publishState">
                                    <?php echo $xEditable->publishable( $item->{'publication.status'}, 'publication.status', $publishStates); ?>
                                </h5>									
	                    	</div>		                    	
	                    	<div class="col-xs-4 col-sm-4 col-md-2">
		                        <a class="btn btn-danger btn-sm" data-bootbox="confirm" href="./admin/language/delete/<?php echo $item->id; ?>">
		                            <i class="fa fa-times"></i> Delete
		                        </a>
	                    	</div>
                        </div>

                    </div>
                </div>
            </div>
            <?php } ?>
            
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
            
            <?php } else { ?>
                <div class="">No items found.</div>
            <?php } ?>
        
        </div>
    
</form>