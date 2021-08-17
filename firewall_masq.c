#include <stdio.h>
#include <string.h>
int main(int argc, char *argv[]){
char msg[100]={0};
setuid(0);

sprintf(msg, "iptables -t nat -A POSTROUTING -s %s/%s -o %s -j MASQUERADE", argv[1], argv[2], argv[3]);
system(msg); 

sprintf(msg, "iptables -I FORWARD -s %s/%s -m state --state NEW -j LOG --log-prefix \"[ MASQUERADE SNAT ] \"", argv[1], argv[2], argv[3]);
system(msg); 
return 0;
}

