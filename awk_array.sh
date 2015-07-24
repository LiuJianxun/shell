#!/bin/bash

cities[1]='beijing'
cities[2]='shanghai'
cities[3]='wuhan'
cities[4]='nanjing'

for i in cities
do
    echo $cities[$i]
done
exit 0
