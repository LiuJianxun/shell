#!/bin/bash

echo $(date +"%Y-%m-%d %H:%M:%S") $1 >> /Library/WebServer/www/jianxun2.log

sleep_time=$(expr $RANDOM % 4 + 1) 

sleep $sleep_time 