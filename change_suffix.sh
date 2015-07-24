#!/bin/bash

for file in `ls | grep -E "^bak|books$"`
do
if [ $file != 'books' ] 
then
    echo ${file%.*}".bak"
    #mv $file ${file%.*}".bak"
else
    echo $file".bak"
    #mv $file $file".bak"
fi
done
exit 0
