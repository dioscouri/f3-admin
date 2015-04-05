<?php
if (!function_exists('apcu_cache_info')) {
    ?>
    <p class="alert alert-danger">You do not have APCu installed</p>
    <?php
    return;
}

/**
 * Fetch configuration and status information
 */
$info = apcu_cache_info();
//echo \Dsc\Debug::dump(array_keys($info));
$mem = apcu_sma_info();

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
?>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-info pull-right" href="./admin/cache/apcu">Refresh</a>
            		<h1 class="page-title txt-color-blueDark">
            			<i class="fa fa-table fa-fw "></i> 
            				APCu
            				
            				<span> > PHP: <?php echo phpversion() ?></span>
            				
            				<span> > APCu: <?php echo phpversion('apcu'); ?></span> 
            		</h1>
                </div>
                <div class="panel-body">
                
                    <?php
                    // hits and misses
                    //----------------------------------------------------------------------
                    $totalHits = $info['num_hits'] + $info['num_misses'];
                    $hitRate = empty($totalHits) ? 0 : round($info['num_hits'] / $totalHits * 100, 2);
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
                    $freeMemory = $mem['avail_mem'];
                    $totalMemory = $mem['num_seg'] * $mem['seg_size'];
                    $usedMemory = $totalMemory - $freeMemory;  
                    $wastedMemory = 0;
                    ?>
                    
                    <h2 id="memory">
                        Memory: <?= size_for_humans($usedMemory+$wastedMemory) ?> of <?= size_for_humans($totalMemory) ?>
                        <small class="text-warning">Used: <?= round(($usedMemory / $totalMemory) * 100, 0) ?>%</small>
                        <small class="text-danger">Wasted: <?= round(($wastedMemory / $totalMemory) * 100, 0) ?>%</small>
                    </h2>
                    
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-warning" style="width: <?= round(($usedMemory / $totalMemory) * 100, 0) ?>%">
                            <span class="sr-only">Used memory</span>
                        </div>
                        <div class="progress-bar progress-bar-danger" style="width: <?= round(($wastedMemory / $totalMemory) * 100, 0) ?>%">
                            <span class="sr-only">Wasted memory</span>
                        </div>                    
                        <div class="progress-bar progress-bar-success" style="width: <?= round(($freeMemory / $totalMemory) * 100, 0) ?>%">
                            <span class="sr-only">Free memory</span>
                        </div>                    
                    </div>                
                    
                    <?php
                    $totalKeys = $info['num_slots'];
                    $usedKeys = $info['num_entries'];
                    $freeKeys = $totalKeys - $usedKeys;
                    ?>
                    <h2 id="keys">
                        Keys: <?= $usedKeys ?> of <?= $totalKeys ?>
                    </h2>
                    
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-warning" style="width: <?= round(($usedKeys / $totalKeys) * 100, 0) ?>%">
                            <span class="sr-only">Used keys</span>
                        </div>
                        <div class="progress-bar progress-bar-success" style="width: <?= round(($freeKeys / $totalKeys) * 100, 0) ?>%">
                            <span class="sr-only">Free keys</span>
                        </div>
                    </div>      
                </div>
                <div class="panel-footer">
                    Inserts: <?php echo $info['num_inserts']; ?>
                    <small class="text-danger">Expunges: <?php echo $info['num_expunges']; ?></small>                
                </div>
            </div>
                
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Items (<?php echo $info['num_entries']; ?>) 
                    <a type="button" class="btn btn-danger pull-right" href="./admin/cache/apcu/reset">Reset all</a>
                    </h3>
                </div>                    

                    <?php
                    // TODO Enable sorting and searching, using usort  
                    $search = $this->input->get('q');
                    $apc = new \APCIterator('user', '/'.$search.'/', APC_ITER_KEY|APC_ITER_MEM_SIZE|APC_ITER_CTIME|APC_ITER_MTIME|APC_ITER_ATIME|APC_ITER_NUM_HITS|APC_ITER_TTL, null);
                    ?>
                
                    <table class="table table-striped">
                        <tr>
                            <th>Options</th>
                            <th>Hits</th>
                            <th>Memory</th>
                            <th>Created</th>
                            <th>Modified</th>
                            <th>Item</th>
                        </tr>
                        <?php
                        $num = 0;
                        foreach ($apc as $key => $var) 
                        {
                            $num++;
                            ?>
                            <tr>
                                <td><a class="btn btn-sm btn-warning" href="./admin/cache/apcu/invalidate?key=<?php echo $var['key'] ?>">Invalidate</a></td>
                                <td><?php echo $var['num_hits'] ?></td>
                                <td><?php echo size_for_humans($var['mem_size']) ?></td>
                                <td><?php echo date( 'Y-m-d H:i:s', $var['creation_time'] ); ?></td>
                                <td><?php echo date( 'Y-m-d H:i:s', $var['modified_time'] ); ?></td>
                                <td>
                                    <a href="./admin/cache/apcu/read?key=<?php echo $var['key']; ?>">
                                    <?php echo $var['key']; ?>
                                    </a>
                                    
                                    <?php if (apcu_exists($var['key'])) { ?>
                                        <a class="btn btn-sm btn-success pull-right" href="./admin/cache/apcu/read?key=<?php echo $var['key']; ?>">
                                           View
                                        </a>
                                    <?php } ?>
                                    
                                    <?php /* ?>
                                    <div>
                                    TTL: <?php echo $var['ttl']; ?>
                                    </div>
                                    */ ?>
                                </td>
                            </tr>
                            <?php 
                        } 
                        ?>
                    </table>
                    
                <div class="panel-footer">
                    <?php echo $info['num_entries']; ?> Entries <small class="text-danger"><?php echo $info['num_entries']-$num; ?> inactive</small>
                </div>   
            </div>

    <?php // echo \Dsc\Debug::dump($mem); ?>
    <?php // echo \Dsc\Debug::dump($info); ?>
    