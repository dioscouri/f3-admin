<?php
/**
 * Fetch configuration and status information from OpCache
 */
$config = opcache_get_configuration();
$status = opcache_get_status();

/**
 * Turn bytes into a human readable format
 * @param $bytes
 */
function size_for_humans($bytes)
{
    if ($bytes > 1048576) {
        return sprintf("%.2f&nbsp;MB", $bytes/1048576);
    } elseif ($bytes > 1024) {
        return sprintf("%.2f&nbsp;kB", $bytes/1024);
    } else {
        return sprintf("%d&nbsp;bytes", $bytes);
    }
}

function getOffsetWhereStringsAreEqual($a, $b)
{
    $i = 0;
    while (strlen($a) && strlen($b) && strlen($a) > $i && $a{$i} === $b{$i}) {
        $i++;
    }

    return $i;
}

function getSuggestionMessage($property, $value)
{
    switch ($property) {
        case 'opcache_enabled':
            return $value ? '' : '<span class="glyphicon glyphicon-search"></span> You should enabled opcache';
            break;
        case 'cache_full':
            return $value ? '<span class="glyphicon glyphicon-search"></span> You should increase opcache.memory_consumption' : '';
            break;
        case 'opcache.validate_timestamps':
            return $value ? '<span class="glyphicon glyphicon-search"></span> If you are in a production environment you should disabled it' : '';
            break;
    }

    return '';
}

function getStringFromPropertyAndValue($property, $value)
{
    if ($value === false) {
        return 'false';
    }

    if ($value === true) {
        return 'true';
    }

    switch ($property) {
        case 'used_memory':
        case 'free_memory':
        case 'wasted_memory':
        case 'opcache.memory_consumption':
            return size_for_humans($value);
            break;
        case 'current_wasted_percentage':
        case 'opcache_hit_rate':
            return number_format($value, 2).'%';
            break;
        case 'blacklist_miss_ratio':
            return number_format($value, 2);
            break;
    }

    return $value;
}

?>

    <div class="row">
    
        <div class="col-md-3 col-sm-4">
            <ul class="nav nav-pills nav-stacked">
                <li class="active">
                    <a href="#tab-summary" data-toggle="tab"> Summary </a>
                </li>
                <li>
                    <a href="#tab-status" data-toggle="tab"> Status </a>
                </li>
                <li>
                    <a href="#tab-configuration" data-toggle="tab"> Configuration </a>
                </li>
                <li>
                    <a href="#tab-scripts" data-toggle="tab"> Scripts </a>
                </li>                                                
            </ul>        
        </div>
        
        <div class="col-md-9 col-sm-8">
            
            <div class="well well-sm">
                <a class="btn btn-info pull-right" href="./admin/opcache">Refresh</a>
        		<h1 class="page-title txt-color-blueDark">
        			<i class="fa fa-table fa-fw "></i> 
        				OPcache
        				
        				<span> > PHP: <?= phpversion() ?></span>
        				
        				<span> > OPcache: <?= $config['version']['version'] ?></span> 
        		</h1>        
            </div>
        
            <div class="tab-content stacked-content">

                <div class="tab-pane fade in active" id="tab-summary">                
                    <?php
                    $stats = $status['opcache_statistics'];
                    $hitRate = round($stats['opcache_hit_rate'], 2);
                    ?>
                    <h2 id="hits">
                        Hits: <?= $hitRate ?>%
                        <small class="text-danger">Misses: <?= (100 - $hitRate) ?>%</small>
                    </h2>
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-success" style="width: <?= $hitRate ?>%">
                            <span class="sr-only">Hits</span>
                        </div>
                        <div class="progress-bar progress-bar-danger" style="width: <?= (100 - $hitRate) ?>%">
                            <span class="sr-only">Misses</span>
                        </div>
                    </div>
                        

                    <?php
                    $mem = $status['memory_usage'];
                    $totalMemory = $config['directives']['opcache.memory_consumption'];
                    $usedMemory = $mem['used_memory'];
                    $freeMemory = $mem['free_memory'];
                    $wastedMemory = $mem['wasted_memory'];
                    ?>
                
                    <h2 id="memory">
                        Memory: <?= size_for_humans($wastedMemory + $usedMemory) ?> of <?= size_for_humans($totalMemory) ?>
                        <small class="text-warning">Used: <?= round(($usedMemory / $totalMemory) * 100, PHP_ROUND_HALF_UP) ?>%</small>
                        <small class="text-danger">Wasted: <?= round(($wastedMemory / $totalMemory) * 100, PHP_ROUND_HALF_UP) ?>%</small>
                    </h2>
                    
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-warning" style="width: <?= round(($usedMemory / $totalMemory) * 100, PHP_ROUND_HALF_UP) ?>%">
                            <span class="sr-only">Used memory</span>
                        </div>
                        <div class="progress-bar progress-bar-danger" style="width: <?= round(($wastedMemory / $totalMemory) * 100, PHP_ROUND_HALF_UP) ?>%">
                            <span class="sr-only">Wasted memory</span>
                        </div>                    
                        <div class="progress-bar progress-bar-success" style="width: <?= round(($freeMemory / $totalMemory) * 100, PHP_ROUND_HALF_UP) ?>%">
                            <span class="sr-only">Free memory</span>
                        </div>                    
                    </div>                

                    <?php
                    $totalKeys = $stats['max_cached_keys'];
                    $usedKeys = $stats['num_cached_keys'];
                    $freeKeys = $totalKeys - $usedKeys;
                    ?>
                    <h2 id="keys">
                        Keys: <?= $usedKeys ?> of <?= $totalKeys ?>
                    </h2>
                    
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-warning" style="width: <?= round(($usedKeys / $totalKeys) * 100, PHP_ROUND_HALF_UP) ?>%">
                            <span class="sr-only">Used keys</span>
                        </div>
                        <div class="progress-bar progress-bar-success" style="width: <?= round(($freeKeys / $totalKeys) * 100, PHP_ROUND_HALF_UP) ?>%">
                            <span class="sr-only">Free keys</span>
                        </div>
                    </div>
                
                </div>
                
                <div class="tab-pane fade in" id="tab-status">
                    <h2 id="status">Status</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <?php
                            foreach ($status as $key => $value) {
                                if ($key == 'scripts') {
                                    continue;
                                }
                
                                if (is_array($value)) {
                                    foreach ($value as $k => $v) {
                                        $v = getStringFromPropertyAndValue($k, $v);
                                        $m = getSuggestionMessage($k, $v);
                                        ?><tr class="<?= $m ? 'danger' : '' ?>"><th align="left"><?= $k ?></th><td align="right"><?= $v ?></td><td><?= $m ?></td></tr><?php
                                    }
                                    continue;
                                }
                
                                $mess = getSuggestionMessage($key, $value);
                                $value = getStringFromPropertyAndValue($key, $value);
                                ?><tr class="<?= $mess ? 'danger' : '' ?>"><th align="left"><?= $key ?></th><td align="right"><?= $value ?></td><td><?= $mess ?></td></tr><?php
                            }
                            ?>
                        </table>
                    </div>                
                
                </div>                
                
                <div class="tab-pane fade in" id="tab-configuration">
                    <h2 id="configuration">Configuration</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <?php foreach ($config['directives'] as $key => $value) {
                                $mess = getSuggestionMessage($key, $value);
                                ?>
                                <tr class="<?= $mess ? 'danger' : '' ?>" >
                                    <th align="left"><?= $key ?></th>
                                    <td align="right"><?= getStringFromPropertyAndValue($key, $value) ?></td>
                                    <td align="left"><?= $mess ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                
                </div>
                
                <div class="tab-pane fade in" id="tab-scripts">
                    <h2 id="scripts">Scripts (<?= count($status["scripts"]) ?>) 
                    <a type="button" class="btn btn-success pull-right" href="./admin/opcache/reset">Reset all</a>
                    </h2>
                    <table class="table table-striped">
                        <tr>
                            <th>Options</th>
                            <th>Hits</th>
                            <th>Memory</th>
                            <th>Path</th>
                        </tr>
                        <?php
                        uasort($status['scripts'], function ($a, $b) { return $a['hits'] < $b ['hits']; });
                
                        $offset = null;
                        $previousKey = null;
                        foreach ($status['scripts'] as $key => $data) {
                            $offset = min(
                                getOffsetWhereStringsAreEqual(
                                    (null === $previousKey) ? $key : $previousKey,
                                    $key
                                ),
                                (null === $offset) ? strlen($key) : $offset
                            );
                            $previousKey = $key;
                        }
                
                        foreach ($status['scripts'] as $key => $data) {
                            ?>
                            <tr>
                                <td><a class="btn btn-sm btn-warning" href="./admin/opcache/invalidate?script=<?= $data['full_path'] ?>">Invalidate</a></td>
                                <td><?= $data['hits'] ?></td>
                                <td><?= size_for_humans($data['memory_consumption']) ?></td>
                                <td><?= substr($data['full_path'], $offset - 1) ?></td>
                            </tr>
                        <?php } ?>
                    </table>   
                                    
                </div>
            </div>        
     
        </div>
    </div>
