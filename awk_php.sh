awk 'BEGIN{ FS=",";RS="\n";ORS="";OFS=","} { 
for (i=1;i<=NF;i++){ 
   if($i==111){
       print "\$goods_id="
   }else{
       if(i==1){
           print $i","
       }else{
           print $i
       }
   }
} print "\n"
}' ./php.txt
