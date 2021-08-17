#include <stdio.h>

int main()
{
	setuid(0);
	system("service openvpn stop");

	return 0;
}
