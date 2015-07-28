#!/bin/bash

p=$1
awk -v p="${p:=5}" 'BEGIN{ FS="\n";RS="";ORS="\n" } {
    for(i=1;i<=NF;i++){
        if(i%p==0 && i!=NF ){
            print $i"\n"
        }else{
            print $i" end here"    
        }
    } 
}' /Users/MLS/shell/mail.log
