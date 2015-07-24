#!/bin/bash

if [ -f /opt/logs/higo/201507/07/free_shipping.log ]
then
    echo The File Exists
else
    echo "Not Exists \n"
fi
exit 0
