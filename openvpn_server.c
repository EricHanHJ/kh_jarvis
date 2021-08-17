#include <stdio.h>
#include <string.h>

int main(int argc,char *argv[])
{
	char msg[100]={0};
	setuid(0);
	sprintf(msg,"echo 'server %s %s' >> /etc/openvpn/server.conf",argv[1],argv[2]);
	system(msg);

	return 0;
}

