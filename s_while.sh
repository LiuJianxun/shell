#!/bin/bash

count=0

while [ $count -lt 10 ];do
    echo The count is $count
    let count+=1
done
exit 0
