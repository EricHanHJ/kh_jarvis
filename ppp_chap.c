#include <stdio.h>
#include <string.h>

int main(int argc, char *argv[])
{
	char k[100]={0};
	setuid(0);
	sprintf(k,"echo '%s  pptpd  %s *' >> /etc/ppp/chap-secrets",argv[1],argv[2]);
	system(k);
	return 0;
}
