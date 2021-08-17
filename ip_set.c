#include <stdio.h>
#include <string.h>

int main(int argc,char *argv[])
{
        // argv[1]=eth
        // argv[2]=ip
        // argv[3]=netmask
        // argv[4]=gw
        // argv[5]=dns
        char interface[100]="/etc/sysconfig/network-scripts/ifcfg-";
        char ifconfig_down[100]={0};
        char ifconfig_up[100]={0};
	char temp[100]={0};
	FILE* fw;
        FILE* fr;
	char dot[4]={"...\0"};
        setuid(0);
        strncat(interface, argv[1], 4);

        fw=fopen(interface,"w");
	fr=fopen("/var/www/html/kh/temp","r");

        fprintf(fw,"DEVICE=");
        fprintf(fw,"%s\n", argv[1]);

        fprintf(fw,"BOOTPROTO=static\n");

        fscanf(fr,"%s",temp);
        fprintf(fw,temp);

        fprintf(fw,"\nONBOOT=yes\n");

        fprintf(fw,"IPADDR=");
        fprintf(fw,"%s\n", argv[2]);

        fprintf(fw,"NETMASK=");
        fprintf(fw,"%s\n", argv[3]);

	if(!((strcmp(argv[4],dot)==0) && (strcmp(argv[5], dot)==0))){
        	fprintf(fw,"GATEWAY=");
       		fprintf(fw,"%s\n", argv[4]);

        	fprintf(fw,"DNS1=");
        	fprintf(fw,"%s", argv[5]);
	}
	
        fclose(fr);
	fclose(fw);

        system("/etc/rc.d/init.d/network restart");
	system("/work/darkstat-3.0.719/darkstat -i eth0 -p 8080");
        return 0;
}

