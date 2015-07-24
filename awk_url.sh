#!/bin/bash

awk 'BEGIN{ FS=" ";OR="\n"} /POST/  {
    for(i=7;i<=15;i++){
        printf("%s \t",$i)
    } 
}' ./access.log | head -30
