#include <stdio.h>
#include <string.h>

int main(){
setuid(0);
system("iptables -D INPUT -p tcp --tcp-flags ACK,FIN FIN -j LOG --log-prefix \"[ NMAP FIN ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags ACK,FIN FIN -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags ACK,PSH PSH -j LOG --log-prefix \"[ NMAP PSH ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags ACK,PSH PSH -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags ACK,URG URG -j LOG --log-prefix \"[ NMAP URG ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags ACK,URG URG -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags ALL ALL -j LOG --log-prefix \"[ NMAP XMAS scan ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags ALL ALL -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags ALL NONE -j LOG --log-prefix \"[ NMAP NULL scan ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags ALL NONE -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags ALL SYN,RST,ACK,FIN,URG -j LOG --log-prefix \"[ NMAP pscan ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags ALL SYN,RST,ACK,FIN,URG -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags SYN,FIN SYN,FIN -j LOG --log-prefix \"[ NMAP pscan 2 ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags SYN,FIN SYN,FIN -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags FIN,RST FIN,RST -j LOG --log-prefix \"[ NMAP pscan 2 ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags FIN,RST FIN,RST -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags ALL SYN,FIN -j LOG --log-prefix \"[ NMAP SYNFIN-SCAN ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags ALL SYN,FIN -j DROP");



system("iptables -D INPUT -p tcp --tcp-flags ALL URG,PSH,FIN -j LOG --log-prefix \"[ NMAP NMAP-XMAS-SCAN ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags ALL URG,PSH,FIN -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags ALL FIN -j LOG --log-prefix \"[ NMAP FIN-SCAN ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags ALL FIN -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags ALL URG,PSH,SYN,FIN -j LOG --log-prefix \"[ NMAP NMAP-ID ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags ALL URG,PSH,SYN,FIN -j DROP");

system("iptables -D INPUT -p tcp --tcp-flags SYN,RST SYN,RST -j LOG --log-prefix \"[ NMAP SYN-RST ] : \"");
system("iptables -D INPUT -p tcp --tcp-flags SYN,RST SYN,RST -j DROP");

return 0;

}

