#include<stdio.h>
#include<string.h>
int main(int argc, char *argv[])
{	
	setuid(0);
	char msg[100]={0};
	sprintf(msg,"service %s status > chk_srv_temp",argv[1]);

	system(msg);

}
