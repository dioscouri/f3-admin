<form id="settings-form" role="form" method="post" class="form-horizontal clearfix">

    <div class="row">
        <div class="col-md-3 col-sm-4">
            <ul id="myTab" class="nav nav-pills nav-stacked">
                <li class="active">
                    <a href="#tab-connection" data-toggle="tab"> Connection Settings </a>
                </li>
                <li>
                    <a href="#tab-database" data-toggle="tab"> Database Settings </a>
                </li>
            </ul>
        </div>

        <div class="col-md-9 col-sm-8">

            <div class="form-actions clearfix">
                <button type="submit" class="btn btn-primary pull-right">Save Changes</button>
            </div>
            
            <hr/>

            <div class="tab-content stacked-content">

                <div class="tab-pane fade in active" id="tab-connection">
                    <h3 class="">Connection Settings</h3>

                    <div class="form-group">
                        <label class="control-label col-md-3">Use SSL?</label>
                        
                        <div class="col-md-7">
                            <label class="radio-inline">
                                <input type="radio" name="sro_ssl" value="0"> No
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="sro_ssl" value="1"> Yes
                            </label>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade in" id="tab-database">
                    <h3 class="">Database Settings</h3>

                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec.</p>
                </div>

            </div>

        </div>
    </div>

</form>
