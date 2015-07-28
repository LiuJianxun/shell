<?php

function worker_processes(){
    $limit = 500; //允许推到后台的最大进程数
    while ($p_number<=0) {
        $cmd = popen("ps -ef | grep \"/Library/WebServer/www/jianxun.sh\" | grep -v grep | wc -l ", "r");
        $line = fread($cmd, 512);
        pclose($cmd);
        $p_number = $limit - $line;
        if($p_number<=0){
            sleep(1);//暂停1秒
        }
    }
    return $p_number;
}

function run($input){
    global $p_number;
    if($p_number<=0){
        $p_number = worker_processes($p_number);
    }
    $p_number -= 1;
    $out = popen("/bin/bash /Library/WebServer/www/jianxun.sh \"{$input}\" &", "r");
    pclose($out);
}

$input    = "http://www.phpxun.com"; //模拟从队列文件中读取到的数据
$p_number = 0;
for($i = 1; $i <= 1000; $i++){
    run($input);
    echo "Idle process number: ".$p_number."\n";
}


?>