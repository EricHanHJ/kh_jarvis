#include <stdio.h>

int main()
{
	setuid(0);
	system("service pptpd restart");

	return 0;
}
