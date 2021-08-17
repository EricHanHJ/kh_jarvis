#include <stdio.h>
#include <string.h>

int main(int argc,char *argv[])
{
	char msg[100]={0};
	setuid(0);
	sprintf(msg,"/sbin/route add -net %s netmask %s dev %s",argv[1],argv[2],argv[3]);
	system(msg);

	return 0;
}

