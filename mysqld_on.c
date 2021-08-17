#include <stdio.h>

int main()
{
	setuid(0);
	system("service mysqld restart");

	return 0;
}
