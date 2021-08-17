#include <stdio.h>

int main()
{
	setuid(0);
	system("service openvpn restart");

	return 0;
}
