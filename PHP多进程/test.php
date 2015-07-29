<?php

$j = $argv[1];

for ($i=0;$i<10;$i++){
    #echo $i."\n";
    file_put_contents('/Library/WebServer/www/test.log', date('Y-m-d H:i:s') . " 测试 + {$i} + From Process + {$j} \n", FILE_APPEND);
    sleep(10);
}

// $i = $argv[1];
// file_put_contents('/Library/WebServer/www/test.txt', date('Y-m-d H:i:s') . " 测试{$i}\n", FILE_APPEND);
// sleep(5);