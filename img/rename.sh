#!/bin/bash
#mkdir newImgDir
for imgFile in `ls | grep "jpg"`;do
#echo ${imgFile%_*}".jpg"
#echo $imgFile | awk -F "_" '{print $1"_"$2".jpg"}'
#cp $imgFile ./newImgDir/${imgFile%_*}".jpg"
done;
