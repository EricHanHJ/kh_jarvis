#include<stdio.h>
int main(){
	setuid(0);
	system("echo 1 > /proc/sys/net/ipv4/ip_forward");

return 0;
}
