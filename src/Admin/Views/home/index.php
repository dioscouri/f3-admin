<?php if (class_exists('\Search\Factory')) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm search">
                <form method="get" action="./admin/search" role="search">
                    <div class="input-group">
                        <input name="q" type="text" class="form-control" placeholder="Search..." />
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit" tabindex="3">Search</button>
                        </span>
                    </div>
                </form>
            </div>            
        </div>        
    </div>
<?php } ?>

<tmpl type="modules" name="admin-dashboard" />