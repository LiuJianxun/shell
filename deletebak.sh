#!/bin/bash


for file in `ls *.bak`
do
    echo ${file%.*}
    mv $file ${file%.*}
done
echo "Done!\n"
exit 0
