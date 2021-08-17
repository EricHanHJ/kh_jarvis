#include <stdio.h>
#include <string.h>

int main(){
setuid(0);

system("iptables -D INPUT -p tcp --dport 80 -m recent --update --seconds 1 --hitcount 15 --name HTTP -j DROP");


return 0;

}

