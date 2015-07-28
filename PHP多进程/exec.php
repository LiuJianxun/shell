<?php
//测试php脚本调用执行linux命令

#exec("/Users/MLS/shell/awk_mail.sh",$result);
#print_r($result);

#exec("du -s ./* | sort -r -n | head -10 ",$result);
#print_r($result);

#exec("ls | grep php",$result);
#print_r($result);

#$file = popen("ps -ef | wc -l","r");
#$line = fread($file,512);
#var_dump($file);
#pclose($file);
#echo "process nums : ".$line;

exec("ps -ef | wc -l",$result);
print_r($result);
