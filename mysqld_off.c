#include <stdio.h>

int main()
{
	setuid(0);
	system("service mysqld stop");

	return 0;
}
