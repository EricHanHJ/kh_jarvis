#include<stdio.h>
int main(){
	setuid(0);
	system("service iptables stop");

return 0;
}
