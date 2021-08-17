#include <stdio.h>
#include <string.h>
int main(int argc, char *argv[]){
char msg[100]={0};
setuid(0);
sprintf(msg, "iptables -D %s -i %s -p %s -s %s/%s -d %s/%s --sport %s --dport %s -j ACCEPT", argv[1], argv[2], argv[3], argv[4], argv[5], argv[6], argv[7], argv[8], argv[9]);
system(msg);

return 0;
}
