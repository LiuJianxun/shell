#!/bin/bash

for i in 1 2 3 4 5 6 7 8 9 10 11 12
do
     /usr/local/php5/bin/php -q /Library/WebServer/www/test.php $i &
done
