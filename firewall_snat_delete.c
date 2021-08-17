#include <stdio.h>
#include <string.h>
int main(int argc, char *argv[]){
char msg[200]={0};
setuid(0);

sprintf(msg,"iptables -D FORWARD -s %s/%s -m state --state NEW -j LOG --log-prefix \"[ SNAT ] : \"", argv[1], argv[2]);
system(msg);

sprintf(msg, "iptables -t nat -D POSTROUTING -s %s -o %s -j SNAT --to-source %s", argv[1], argv[3], argv[4]);
system(msg);
return 0;
}

