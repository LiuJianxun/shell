#!/bin/bash

for shfile in `find . -type f -name "*.sh"`;
do

echo $shfile ; 
cat $shfile | wc -l

done
