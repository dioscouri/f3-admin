<?php // TODO Move this to a module or listener in f3-activity ?>
<?php if (!class_exists('\Activity\Models\Actions')) { return; } ?>

<?php
$total = 0;

$class = "\Activity\Models\Dashboard\\" . ucwords($active);
if (class_exists($class)) 
{
    $model = new $class;
    $total = $model->total();
    $chartdata = $model->chartData();    
}

?>

<hr/>

<div class="row">
    <div class="col-md-6">
        <h4 class="clearfix">
            <a href="./admin/activities/actions">
                Visitors
                <small class="pull-right"><?php echo (int) $total; ?> total</small>
            </a>
        </h4>
        <hr/>
        <div class="well well-sm">
            <div id="activity_stats_chart_div" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-md-3">
        <h4 class="clearfix">
            Traffic Sources
            <small class="pull-right">(coming soon)</small>
        </h4>
        <hr/>            
        <div class="list-group">
            <div class="list-group-item">
                <small>Direct</small>
                91% (101)
            </div>
            
            <div class="list-group-item">
                <small>Referrals</small>
                9% (10)
            </div>
            
            <div class="list-group-item">
                <small>Search Engines</small>
                0% (0)
            </div>
        </div>            
    </div>
    <div class="col-md-3">
        <h4 class="clearfix">
            Popular Pages
            <small class="pull-right">(coming soon)</small>
        </h4>
        <hr/>            
        <div class="list-group">
            <div class="list-group-item">
                <small>Home</small>
                15% (20)
            </div>
            
            <div class="list-group-item">
                <small>Cart</small>
                12% (12)
            </div>
            
            <div class="list-group-item">
                <small>Shop</small>
                1% (1)
            </div>
                        
            <div class="list-group-item">
                <small>Blog</small>
                1% (1)
            </div>
        </div>                
    </div>                
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
var data = google.visualization.arrayToDataTable(<?php echo json_encode($chartdata['results']); ?>);
    var options = {
      hAxis: {title: '<?php echo $chartdata['haxis.title']; ?>', titleTextStyle: {color: 'red'}}
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('activity_stats_chart_div'));
    chart.draw(data, options);
  }

  $(window).resize(function(){
	  drawChart();
	});  
</script>
