#include <stdio.h>
#include <string.h>

int main(int argc,char *argv[])
{
	char msg[100]={0};
	setuid(0);
	sprintf(msg,"cp /etc/openvpn/server-back.conf /etc/openvpn/server.conf");
	system(msg);

	return 0;
}

