#include<stdio.h>
int main(){
	setuid(0);
	system("service crond stop");

return 0;
}
