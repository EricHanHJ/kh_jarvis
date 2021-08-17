#include <string.h>
#include <stdio.h>
#include <stdlib.h>

int main()
{
        FILE* fr = NULL;
        FILE* fw = NULL;
	char *line = NULL;
        size_t len = 0;
        ssize_t read;

	char hwaddr[8]={"HWADDR="};
        setuid(0);
	fr=fopen("/etc/sysconfig/network-scripts/ifcfg-eth1","r");
	fw=fopen("/var/www/html/kh/temp","w");
	if(fr==NULL)
		exit(EXIT_FAILURE);
	while((read=getline(&line, &len, fr)) != -1){
		if(!strncmp(hwaddr, line, 7)){
			fprintf(fw, line);
		} 

        }
        free(line);
	fclose(fw);
        fclose(fr);
}
