#!/bin/bash

awk 'BEGIN{ FS=":" } /hald/,/mysql/ {
if ( NR <= 3 ){
print $0 
}
} ' /etc/passwd
