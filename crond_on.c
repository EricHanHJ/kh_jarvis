#include<stdio.h>
int main(){
	setuid(0);
	system("service crond restart");

return 0;
}
