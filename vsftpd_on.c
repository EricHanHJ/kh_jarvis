#include <stdio.h>

int main()
{
	setuid(0);
	system("service vsftpd restart");

	return 0;
}
