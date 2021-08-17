#include <stdio.h>
#include <string.h>
int main(int argc, char *argv[]){
char msg[100]={0};
setuid(0);
sprintf(msg,"iptables -I FORWARD -d %s/%s -m state --state NEW -j LOG --log-prefix \"[ DNAT ] : \"", argv[3], argv[4]);
						// exipaddr / exinf / inip
system(msg);

sprintf(msg, "iptables -t nat -A PREROUTING -d %s -i %s -j DNAT --to-destination %s", argv[1], argv[2], argv[3]);
system(msg); 

return 0;
}

