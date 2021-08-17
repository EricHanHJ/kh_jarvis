#include <stdio.h>
#include <string.h>

int main(){
setuid(0);

system("iptables -D INPUT -p tcp -m limit --limit 10/s -j DROP");
system("iptables -D INPUT -p tcp -m limit --limit 100/m --limit-burst 10 -j DROP");

/*
TCP패킷이 초당 10개가 올 경우 차단
하나의 세션에서 10개의 패킷이 매칭된 후 TCP패킷이 분당 100개가 올 경우 차단
*/
system("iptables -A INPUT -p tcp -m limit --limit 10/s -j DROP");
system("iptables -A INPUT -p tcp -m limit --limit 100/m --limit-burst 10 -j DROP");


return 0;

}

