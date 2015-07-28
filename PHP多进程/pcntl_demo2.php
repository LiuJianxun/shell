<?php
//PHP pcntl多进程demo2

for($x = 1;$x<= 2;$x++){
    $pid[$x] = pcntl_fork();
    if ($pid[$x] == -1) {
        die("could not fork");
    } elseif ($pid[$x]) {
        echo "Parent: create ".$pid[$x]."\n";
    } else {
        echo "fork ".getmypid()." start:\n";
        for($i = 0;$i<10;$i++){
            echo $x.": ".$i."\n";
            sleep(3);
        }
        exit;
    }
}

while(count($pid) > 0){
    $myId = pcntl_waitpid(-1, $status, WNOHANG);
    foreach($pid as $k => $v){
        if($myId == $v) unset($pid[$k]);
    }
    usleep(100);
}


?>