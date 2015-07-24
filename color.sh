#!/bin/bash

for ((i=0;i<=7;i++))
do
    begin="\e[1;"
    end="\e[0m"
    param=$((30+i))"m"
    echo -e "${begin}${param}世界那么大，我想去看看！${end}"
done
exit 0
