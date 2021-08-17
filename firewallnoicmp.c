#include <stdio.h>
#include <string.h>

int main(){
setuid(0);


system("iptables -D INPUT -p icmp -j ICMP");
system("iptables -D ICMP -p icmp --icmp-type 8 -j DROP");
system("iptables -X ICMP");

return 0;

}

