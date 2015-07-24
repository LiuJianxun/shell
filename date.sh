#!/bin/bash

#t_t="17-Apr-2015"
#date '+%Y-%m-%d %H:%M:%S' -d "$t_t"
#exit 0
#for line in `sed -e 's/ //;s/:/ /;s/\// /g' ./sjm.txt`
#do
#    echo $line"============="
#done
#exit 0

#sed -e 's/ //;s/:/ /;s/\// /g' ./sjm.txt | awk -F ' ' '{print "'`date +%Y-%m-%d -d "$1"`'" $2}'
#sed -e 's/ //;s/:/ /;s/\//-/g' ./sjm.txt | awk -F ' ' '{print "'`date '+%Y-%m-%d' -d "$d"`' "$2}' 

#方法1
#sed -e 's/ //;s/:/ /;s/\//-/g' ./sjm.txt | awk -F ' ' '{system("date +%Y-%m-%d -d " $1);print $2"\n"}' | awk 'BEGIN{ FS="\n";RS="";OFS=" ";ORS="\n"} {print $1,$2}'
#exit 0;

#方法2
sed -e 's/ //;s/:/ /;s/\//-/g' ./sjm.txt | awk -F ' ' '{"date +%Y-%m-%d -d" $1|getline d;print d" "$2}'
exit 0
