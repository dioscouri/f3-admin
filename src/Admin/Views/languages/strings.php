<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> 
            <a href="./admin/languages">Languages</a>
            <span> > 
                <a class="" href="./admin/language/edit/<?php echo $item->id; ?>">
				    <?php echo $item->title; ?>
				</a>             
            </span>
			<span> >
                Strings
			</span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
		<div class="pull-right">
            <a class="btn btn-link" href="./admin/language/edit/<?php echo $item->id; ?>">Back to Editing Language</a>
		</div>
    </div>
</div>

<hr/>

<ul class="nav nav-tabs">
    <li class="active">
        <a href="#tab-strings" data-toggle="tab"> Current Strings </a>
    </li>    
    <li>
        <a href="#tab-new" data-toggle="tab"> New Strings </a>
    </li>
</ul>

<div class="tab-content">

    <div class="tab-pane active" id="tab-strings">

        <div class="panel panel-default">
            <div class="panel-body">    
            
                <form action="./admin/language/<?php echo $item->id; ?>/strings" method="post">
                    <div class="form-group pull-right clearfix">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>            
                
                    <?php 
                    // TODO if this is not the default language, load the 'default_compare.php' layout in a tab 
                    // get the default language's keys.  loop through them all. if a corresponding translated key exists, display it in a text box
                    // otherwise, display an empty textarea
                    $strings = (new \Dsc\Mongo\Collections\Translations\Strings)->setState('filter.lang_id', $item->id)->getItem();
                    if (empty($strings->id)) {
                        $strings = new \Dsc\Mongo\Collections\Translations\Strings;
                    }
                    ?>
                
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Key/Title</th>
                                <th>Translation</th>
                            </tr>
                        </thead>            
                        <?php foreach (\Dsc\Mongo\Collections\Translations\Keys::find() as $key) { ?>
                        <tr>
                            <td><?php echo $key->slug; ?></td>
                            <td>
                                <textarea class="form-control" rows="3" name="strings[<?php echo $key->slug; ?>]"><?php echo $strings->{'strings.' . $key->slug }; ?></textarea>
                                <?php ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    
                    <div class="form-group pull-right clearfix">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>            
                
                </form>
            </div>
        </div>
        
    </div>
    <!-- /.tab-pane -->
    
    <div class="tab-pane" id="tab-new">
        <?php echo $this->renderLayout('Admin/Views::languages/new_string.php'); ?>
    </div>
    
</div>
