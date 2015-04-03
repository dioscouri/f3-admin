<div class="panel panel-default">
    <div class="panel-body">
        
        <div id="form-validation"></div>
        
        <form id="new-strings-form" action="./admin/translations/language/<?php echo $item->id; ?>/keys/create" method="post">
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Key/Title</label>
                        <input type="text" name="title" value="" class="form-control">
                    </div>        
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Translation</label>
                        <input type="text" name="value" value="" class="form-control">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-block btn-primary">Create</button>
                    </div>                
                    
                </div>
            </div>
        </form>
        
        <script>
        $(document).ready(function(){
            $('#new-strings-form').on('submit', function(ev){
                ev.preventDefault();

                var form = $(this); 
                var container = $('#form-validation');

                container.removeClass().html('');
                
                var request = $.ajax({
                    type: 'post', 
                    data: form.serialize(),
                    url: form.attr('action')
                }).done(function(data){
                    var lr = jQuery.parseJSON( JSON.stringify(data), false);
                    if (lr.error) {
                        container.removeClass().addClass('alert alert-danger').html(lr.html);
                    } else {
                        container.removeClass().addClass('alert alert-info').html(lr.html);
                        form.find(':input').val('');
                    }
                });
            });
        });
        </script>
    </div>
</div>