#include <stdio.h>
#include <string.h>

int main(){
setuid(0);

system("iptables -D INPUT -p tcp -m limit --limit 10/s -j DROP");
system("iptables -D INPUT -p tcp -m limit --limit 100/m --limit-burst 10 -j DROP");



return 0;

}

