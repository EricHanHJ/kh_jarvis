#include <stdio.h>
#include <string.h>

int main(int argc,char *argv[])
{
	char msg[100]={0};
	setuid(0);
	sprintf(msg,"echo 'max-clients %s' >> /etc/openvpn/server.conf",argv[1]);
	system(msg);

	return 0;
}

