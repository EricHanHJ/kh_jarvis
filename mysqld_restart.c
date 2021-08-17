#include <stdio.h>
#include <string.h>

int main(int argc,char *argv[])
{
        setuid(0);
	system("service mysqld restart");
        return 0;
}

