#!/bin/bash
mkdir testImgDir
for imgFile in `ls | grep "jpg"`;do
tmpImg=${imgFile%.*}"_$1.jpg";
echo $tmpImg;
cp $imgFile ./testImgDir/${tmpImg}
done;
