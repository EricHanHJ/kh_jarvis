#include <stdio.h>

int main()
{
	setuid(0);
	system("service portsentry stop");

	return 0;
}
