<?php // TODO Move this to a module or listener in f3-activity ?>
<?php if (!class_exists('\Activity\Models\Actions')) { return; } ?>

<?php 
$list = (new \Activity\Models\Actions)->setParam('limit', 10)->getList();
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <div class="clearfix">
            <div class="pull-left">
                <h3 class="panel-title"><i class="fa fa-eye"></i> Activity Feed </h3>
            </div>
            <?php /* ?>
            <div class="panel-toolbar widget-toolbar pull-right">
                <div class="btn-group">
                	<button class="btn dropdown-toggle btn-xs btn-warning" data-toggle="dropdown">
                		Show <i class="fa fa-caret-down"></i>
                	</button>
                	<ul class="dropdown-menu pull-right">
                		<li>
                			<a href="javascript:void(0);">Front-end activity only</a>
                		</li>
                		<li>
                			<a href="javascript:void(0);">Admin activity only</a>
                		</li>
                		<li>
                			<a href="javascript:void(0);">Shop activity only</a>
                		</li>
                	</ul>
                </div>                    
            </div>
            */ ?>        
        </div>
        
    </div>
    
    <?php /* ?>
    <div class="alert alert-danger">
        <p>[use pusher to update this realtime?]</p> 
        <p>[ajax call upon clicking dropdown to load filtered data and tell pusher what filter is in place]</p>        
    </div>
    */ ?>
    
    <div id="activities-list" class="list-group">
    <?php foreach ($list as $event) : ?>
        <div class="list-group-item clearfix">
            <span class="text-success"><?php echo $event->actor_name; ?></span> did an event: <b class="text-success"><?php echo $event->action; ?></b>
            <span class="pull-right"><?php echo date( 'Y-m-d g:i a', $event->created ); ?></span>
        </div>
     <?php endforeach; ?>   
    </div>
    
    
    <div class="panel-footer">
        <a class="" href="./admin/activities/actions">View all activity</a>
    </div>        
</div>
<?php if(class_exists('\Pusher\Pusher')) : ?>
<?php
$settings = Pusher\Models\Settings::fetch(); 
if($settings->{'pusher.key'}) : ?>
<script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
<script type="text/javascript">
    // Enable pusher logging - don't include this in production
    Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };

	function addEvent(data) {
	html = '<div class="list-group-item newEvent"><a href="/admin/activities/actor/'+ data.actor_id +'">'+data.actor_id +'</a> did an event: '+ data.action +'</div>';
		$('#ActivitiesList').prepend(html);


		$('.newEvent').fadeTo(1000, 0.5, function() { $('.newEvent').fadeTo(800, 1).removeClass('newEvent'); });
		
	}

	
    var pusher = new Pusher('<?php echo $settings->{'pusher.key'} ?>');
    var channel = pusher.subscribe('dashboard');
    channel.bind('event', function(data) {
		addEvent(data);
    });
  </script>
<?php endif; ?>
<?php endif; ?>

<?php /* Coming soon ?>
<script type="text/javascript">
jQuery(document).ready(function(){
	if ("WebSocket" in window) {                                         
        ws = new WebSocket("ws://" + document.domain + ":8080");                
        ws.onmessage = function (msg) {                                  
            $("#activities-list").prepend(msg.data)                      
        };                                                               
    } else {                                                             
        console.log("WebSocket not supported");                                
    }
});
</script>
*/ ?>
