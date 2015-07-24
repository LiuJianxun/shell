#!/bin/bash
find ./ -name *.c | while read i
do
     echo "$i";
     mv $i.JPG  $i.jpg
done
