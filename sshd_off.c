#include <stdio.h>

int main()
{
	setuid(0);
	system("service sshd stop");

	return 0;
}
