#include <stdio.h>

int main()
{
	setuid(0);
	system("service portsentry restart");

	return 0;
}
