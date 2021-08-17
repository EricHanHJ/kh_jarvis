#include<stdio.h>
int main(){
	setuid(0);
	system("service iptables restart");

return 0;
}
