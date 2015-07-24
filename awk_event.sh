#!/bin/bash

#awk 'BEGIN{ FS="\n";RS="" } {print $1"\t\t"$2"\t\t"$3}' ./t.txt

#awk 'BEGIN{ FS="\n";RS="";OFS="\t\t";ORS="\n"} {print $1,$2,$3}' ./t.txt

awk 'BEGIN{ FS="\n";RS="";ORS=""} { 

for (i=1;i<=NF;i++){ 
if(i%10==0){
     print $i"\n"
}else{
     print $i","
}
}
print "\n"
}' ./event_id.txt
