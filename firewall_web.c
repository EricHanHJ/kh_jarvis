#include <stdio.h>
#include <string.h>
int main(int argc, char *argv[]){
char msg[100]={0};
setuid(0);
sprintf(msg, "iptables -I FORWARD -p tcp --dport 80 -s %s/%s -m string --string \"%s\" --algo bm -j DROP", argv[1], argv[2], argv[3]);
system(msg); 
sprintf(msg, "iptables -I FORWARD -p tcp --dport 80 -s %s/%s -m string --string \"%s\" --algo bm -j LOG --log-prefix \"[ BLOCK : %s ]\"", argv[1], argv[2], argv[3], argv[3]);
system(msg); 

return 0;
}

