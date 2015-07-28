<?php
//PHP pcntl多进程demo

for($x = 1;$x<= 3;$x++){
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

?>