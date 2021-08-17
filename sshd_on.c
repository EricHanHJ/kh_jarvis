#include <stdio.h>

int main()
{
	setuid(0);
	system("service sshd restart");

	return 0;
}
