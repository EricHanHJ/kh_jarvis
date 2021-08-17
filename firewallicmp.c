#include <stdio.h>
#include <string.h>

int main(){
setuid(0);


system("iptables -D INPUT -p icmp -j ICMP");
system("iptables -D ICMP -p icmp --icmp-type 8 -j DROP");
system("iptables -X ICMP");

/*
ICMP 체인 생성
ICMP 패킷 들어오면 ICMP체인으로 전달
ICMP 체인에 ping에 대한 응답하지 않는 정책 추가
*/
system("iptables -N ICMP");
system("iptables -A INPUT -p icmp -j ICMP");
system("iptables -A ICMP -p icmp --icmp-type 8 -j DROP");

return 0;

}

