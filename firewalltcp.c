#include <stdio.h>
#include <string.h>

int main(){
setuid(0);
system("iptables -D INPUT -p tcp --tcp-flags ALL SYN,FIN -j DROP");
system("iptables -D INPUT -p tcp --tcp-flags ALL PSH,FIN -j DROP");
system("iptables -D INPUT -p tcp ! --syn -m state --state NEW -j DROP");
system("iptables -D INPUT -p tcp ! --tcp-flags SYN,RST,ACK SYN -m state --state NEW -j DROP");
system("iptables -D INPUT -p tcp ! --tcp-flags ALL SYN -m state --state NEW -j DROP");

system("iptables -A INPUT -p tcp --tcp-flags ALL SYN,FIN -j DROP");
system("iptables -A INPUT -p tcp --tcp-flags ALL PSH,FIN -j DROP");
system("iptables -A INPUT -p tcp ! --syn -m state --state NEW -j DROP");
system("iptables -A INPUT -p tcp ! --tcp-flags SYN,RST,ACK SYN -m state --state NEW -j DROP");
system("iptables -A INPUT -p tcp ! --tcp-flags ALL SYN -m state --state NEW -j DROP");
return 0;

}

