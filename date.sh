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
sed -e 's/ //;s/:/ /;s/\//-/g' ./sjm.txt | awk -F ' ' '{system("date +%Y-%m-%d -d " $1);print $2"\n"}' | awk 'BEGIN{ FS="\n";RS="";OFS=" ";ORS="\n"} {print $1,$2}'
exit 0;



str=`sed -e 's/ //;s/:/ /;s/\// /g' ./sjm.txt`
echo $str
exit 0


for((i=0;i<=10;i++))
do
    echo str[$i]."--------"
done
exit 0


echo $str
#awk -F '+' '{print $1 $2}' | $str
