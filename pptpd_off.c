#include <stdio.h>

int main()
{
	setuid(0);
	system("service pptpd stop");

	return 0;
}
