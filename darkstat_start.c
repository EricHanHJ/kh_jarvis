#include <stdio.h>
#include <string.h>

int main(int argc,char *argv[])
{
        setuid(0);
	FILE* fw;
	fw=fopen("/var/www/html/kh/tttt", "w");
	fprintf(fw,"ddddd");
	system("/work/darkstat-3.0.719/darkstat -i eth0 -p 8080");
        return 0;
}

