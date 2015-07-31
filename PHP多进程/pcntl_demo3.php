<?php
//PHP pcntl多进程demo3

$max     = 800000;
$workers = 10;
$size    = $max / $workers;
  
$pids = array();
for($i = 0; $i < $workers; $i++){
    $pids[$i] = pcntl_fork();
    switch ($pids[$i]) {
        case -1:
            echo "fork error : {$i} \r\n";
            exit;
        case 0:
            #$param = array(
            #    'lastid' => $size * $i,
            #    'maxid' => $size * ($i+1)
            #);
            #// $this->executeWorker($input, $output, $param);
            #print_r($param);
            #exit;
            $pid = getmypid();
            echo "fork ".getmypid()." start:\n";
            for($j = 0;$j<10;$j++){
                echo $pid.": ".$j."\n";
                sleep(3);
            }
            exit;
        default:
            break;
    }
}
  
foreach ($pids as $i => $pid) {
    if($pid) {
        pcntl_waitpid($pid, $status);
    }
}
