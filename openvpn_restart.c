#include <stdio.h>
#include <string.h>

int main(int argc,char *argv[])
{
	char msg[100]={0};
	setuid(0);
	sprintf(msg,"service openvpn restart");
	system(msg);

	return 0;
}

