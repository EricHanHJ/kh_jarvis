#include <stdio.h>

int main()
{
	setuid(0);
	system("service vsftpd stop");

	return 0;
}
