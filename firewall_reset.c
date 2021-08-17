#include<stdio.h>
int main(){
	setuid(0);
	system("/var/www/html/kh/iptables_reset.sh");

return 0;
}
