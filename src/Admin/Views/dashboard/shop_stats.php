<?php // TODO Move this to a module or listener in f3-shop ?>
<?php if (!class_exists('\Shop\Models\Dashboard')) { return; } ?>
<?php
$class = "\Shop\Models\Dashboard\\" . ucwords($active);
$model = new $class;
$total = $model->totalSales();
$topsellers = $model->topSellers();
$salesdata = $model->salesData();
?>

<hr/>

<div class="row">
    <div class="col-md-6">
        <h4 class="clearfix">
            <a href="./admin/shop/orders">
            Total Sales
            <?php if (isset($total['total'])) { ?>
            <small class="pull-right"><?php echo \Shop\Models\Currency::format( $total['total'] ); ?> total (<?php echo $total['count']; ?>)</small>
            <?php } ?>
            </a>
        </h4>
        <hr/>
        <div class="well well-sm">
            <div id="shop_stats_chart_div" style="width: 100%; height: 300px;"></div>
        </div>
    </div>
    <div class="col-md-3">
        <h4 class="clearfix">
            Top Sellers
            <small class="pull-right">View Report</small>
        </h4>
        <hr/>            
        <div class="list-group">
            <?php if (!empty($topsellers)) { ?>
                <?php foreach ($topsellers as $topseller) { ?>
                    <div class="list-group-item">
                        <?php echo $topseller->title; ?> (<?php echo (int) $topseller->__total; ?>)
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="list-group-item">
                    No products sold during this date range.
                </div>                
            <?php } ?>
        </div>            
    </div>
    <div class="col-md-3">
        <h4 class="clearfix">
            Conversions
            <small>(coming soon)</small>
        </h4>
        <hr/>            
        <div class="list-group">
            <div class="list-group-item">
                <small>Added to Cart</small>
                15% (20)
            </div>
            
            <div class="list-group-item">
                <small>Reached Checkout</small>
                2% (2)
            </div>
            
            <div class="list-group-item">
                <small>Completed Checkout</small>
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
	  <?php /* ?>
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Sales', 'Expenses'],
      ['2004',  1000,      400],
      ['2005',  1170,      460],
      ['2006',  660,       1120],
      ['2007',  1030,      540]
    ]);
*/ ?>
var data = google.visualization.arrayToDataTable(<?php echo json_encode($salesdata['results']); ?>);
    var options = {
      hAxis: {title: '<?php echo $salesdata['haxis.title']; ?>', titleTextStyle: {color: 'red'}}
    };

    var chart = new google.visualization.AreaChart(document.getElementById('shop_stats_chart_div'));
    chart.draw(data, options);
  }

  $(window).resize(function(){
	  drawChart();
	});  
</script>