#!/bin/bash

AWK_FILTER="/2014:01:00/,/2014:05:00/"

awk $AWK_FILTER'{ 
    printf("%s ",$1)
    for(i=12;i<NF;i++) { 
		printf("%s", $i); 
	}
    printf("%s\n",$NF)
}' ~/shell/access.log \
| awk -F '"' '{ 
	++count[$1]; 
	ua[$1]=$2
} 

END{ 
	for(x in count) {
		print count[x] , x , ua[x]
	}
}' \
| sort -n -r | head -10
