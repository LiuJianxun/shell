#/bin/bash
#this is a renamehost programe

HOSTNAME=$1

if [ ! $HOSTNAME ]; then
    echo "[error] please run like this: $0 [hostname]"
    exit 1
fi

echo $HOSTNAME > /proc/sys/kernel/hostname

echo "NETWORKING=yes
NETWORKING_IPV6=no
HOSTNAME=$HOSTNAME" > /etc/sysconfig/network

echo "[change ok] new hostname is: "$( hostname )
