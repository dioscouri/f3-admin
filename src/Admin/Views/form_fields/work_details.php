<div class="row">
    <div class="col-md-2">
        
        <h3>Subtitle</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Subtitle</label>
            <input type="text" name="subtitle" placeholder="Subtitle" value="<?php echo $flash->old('subtitle'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
            
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row --> 

<hr/>

<div class="row">
    <div class="col-md-2">
        
        <h3>URL</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Website URL</label>
            <input type="text" name="website_url" placeholder="e.g. http://dioscouri.com" value="<?php echo $flash->old('website_url'); ?>" class="form-control" />
        </div>
        <!-- /.form-group -->
            
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row --> 

<hr/>

<div class="row">
    <div class="col-md-2">
        
        <h3>Client</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Select a Client</label>
            <select class="form-control" name="works[client_id]">
                <?php foreach (\Dioscouri\Models\Clients::find(array('sort'=>array('title' => 1))) as $client) {?>
                <option value="<?php echo $client->id; ?>" <?php if ($flash->old('works.client_id') == $client->id) { echo 'selected'; } ?>><?php echo $client->title; ?></option>
                <?php } ?>
            </select>
        </div>
        <!-- /.form-group -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row -->

<hr/>

<div class="row">
    <div class="col-md-2">
    
        <h3>Launched</h3>
        
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">

        <div class="form-group">
            <label>Select a Launch Date:</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="works[launch_date]" value="<?php echo $flash->old('works.launch_date', date('Y-m-d') ); ?>" class="ui-datepicker form-control" type="text" data-date-format="yyyy-mm-dd" data-date-today-highlight="true" data-date-today-btn="true">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>                    
                </div>
            </div>
        </div>
        <!-- /.form-group -->
    
    </div>
    <!-- /.col-md-10 -->
</div>
<!-- /.row -->

<hr/>

<div class="row">
    <div class="col-md-2">
        
        <h3>Categories</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Search existing categories or create a new one...</label>
            <input id="categories" name="categories" type="text" class="form-control" value="<?php echo !empty($item->id) ? implode(",", (array) $item->categories() ) : null; ?>">
            
            <script>
            jQuery(document).ready(function() {
                
                jQuery("#categories").select2({
                    allowClear: true, 
                    tokenSeparators: [",", ";"],
                    createSearchChoice: function(term) {
                        return {id: $.trim(term), text: $.trim(term)};
                    },
                    multiple: true,
                    minimumInputLength: 1,
                    ajax: {
                        url: "./admin/dioscouri/works/categories/forSelection",
                        dataType: 'json',
                        data: function (term, page) {
                            return {
                                q: term
                            };
                        },
                        results: function (data, page) {
                            return {results: data.results};
                        }
                    },
                    sortResults: function(results, container, query) {
                        if (query.term) {
                            // use the built in javascript sort function
                            return results.sort(function(a, b) {
                                if (a.text.length > b.text.length) {
                                    return 1;
                                } else if (a.text.length < b.text.length) {
                                    return -1;
                                } else {
                                    return 0;
                                }
                            });
                        }
                        return results;
                    }                    
                    <?php if ($array = !empty($item->id) ? $item->categories() : array()) { ?>
                    , initSelection : function (element, callback) {
                        var data = <?php echo json_encode( array_map( function($value) {
                            $result = array(
                                    'id' => $value,
                                    'text' => $value
                                );
                            return $result;
                        }, $array ) ); ?>;
                        callback(data);            
                    }
                    <?php } ?>                    
                });
            
            });
            </script>
            
        </div>
        <!-- /.form-group -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row -->

<hr/>

<div class="row">
    <div class="col-md-2">
        
        <h3>Technologies Used</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Search existing technologies or create a new one...</label>
            <input id="technologies" name="technologies" type="text" class="form-control" value="<?php echo !empty($item->id) ? implode(",", (array) $item->technologies() ) : null; ?>">
            
            <script>
            jQuery(document).ready(function() {
                
                jQuery("#technologies").select2({
                    allowClear: true, 
                    tokenSeparators: [",", ";"],
                    createSearchChoice: function(term) {
                        return {id: $.trim(term), text: $.trim(term)};
                    },
                    multiple: true,
                    minimumInputLength: 1,
                    ajax: {
                        url: "./admin/dioscouri/works/technologies/forSelection",
                        dataType: 'json',
                        data: function (term, page) {
                            return {
                                q: term
                            };
                        },
                        results: function (data, page) {
                            return {results: data.results};
                        }
                    },
                    sortResults: function(results, container, query) {
                        if (query.term) {
                            // use the built in javascript sort function
                            return results.sort(function(a, b) {
                                if (a.text.length > b.text.length) {
                                    return 1;
                                } else if (a.text.length < b.text.length) {
                                    return -1;
                                } else {
                                    return 0;
                                }
                            });
                        }
                        return results;
                    }
                    <?php if ($array = !empty($item->id) ? $item->technologies() : array() ) { ?>
                    , initSelection : function (element, callback) {
                        var data = <?php echo json_encode( array_map( function($value) {
                            $result = array(
                                    'id' => $value,
                                    'text' => $value
                                );
                            return $result;
                        }, $array ) ); ?>;
                        callback(data);            
                    }
                    <?php } ?>                    
                });
            
            });
            </script>
        </div>
        <!-- /.form-group -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row -->

<hr/>

<div class="row">
    <div class="col-md-2">
        
        <h3>Integrations</h3>
                
    </div>
    <!-- /.col-md-2 -->
                
    <div class="col-md-10">
    
        <div class="form-group">
            <label>Search existing integrations or create a new one...</label>
            <input id="integrations" name="integrations" type="text" class="form-control" value="<?php echo !empty($item->id) ? implode(",", (array) $item->integrations() ) : null; ?>">
            
            <script>
            jQuery(document).ready(function() {
                
                jQuery("#integrations").select2({
                    allowClear: true, 
                    tokenSeparators: [",", ";"],
                    createSearchChoice: function(term) {
                        return {id: $.trim(term), text: $.trim(term)};
                    },
                    multiple: true,
                    minimumInputLength: 1,
                    ajax: {
                        url: "./admin/dioscouri/works/integrations/forSelection",
                        dataType: 'json',
                        data: function (term, page) {
                            return {
                                q: term
                            };
                        },
                        results: function (data, page) {
                            return {results: data.results};
                        }
                    },
                    sortResults: function(results, container, query) {
                        if (query.term) {
                            // use the built in javascript sort function
                            return results.sort(function(a, b) {
                                if (a.text.length > b.text.length) {
                                    return 1;
                                } else if (a.text.length < b.text.length) {
                                    return -1;
                                } else {
                                    return 0;
                                }
                            });
                        }
                        return results;
                    }
                    <?php if ($array = !empty($item->id) ? $item->integrations() : array() ) { ?>
                    , initSelection : function (element, callback) {
                        var data = <?php echo json_encode( array_map( function($value) {
                            $result = array(
                                    'id' => $value,
                                    'text' => $value
                                );
                            return $result;
                        }, $array ) ); ?>;
                        callback(data);            
                    }
                    <?php } ?>                    
                });
            
            });
            </script>
        </div>
        <!-- /.form-group -->
        
    </div>
    <!-- /.col-md-10 -->
    
</div>
<!-- /.row -->

<hr/>