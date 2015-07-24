#!/bin/bash

BASE=$1

awk -v BASE="${BASE:=10}" 'BEGIN{ FS="\n";RS="";ORS=""} { 
for (i=1;i<=NF;i++){ 
if(i==NF || i%BASE==0){
     print $i"\n"
}else{
     print $i","
}
}
}' ./event_id.txt
