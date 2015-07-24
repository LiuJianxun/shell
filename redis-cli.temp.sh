#!/bin/bash

ID=1

while(($ID<10))
do
	INSTANCE_NAME="i-2-{$ID}-VM"
	PRIVATE_IP_ADDRESS=10.`echo $(( $RANDOM % 255 + 1 ))`.`echo "$RANDOM % 255 + 1" | bc`.`echo "$RANDOM % 255 + 1" | bc`\
	CREATED=`date +"%Y-%m-%d %H:%M:%S"`	

	echo "{$INSTANCE_NAME}-----{$ID}"
	echo "{$PRIVATE_IP_ADDRESS}------{$ID}"
	echo $CREATED

	ID=$(( $ID + 1 ))
done
exit 0

