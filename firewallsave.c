#include <stdio.h>
#include <string.h>
int main(){
setuid(0);
system("service iptables save");

return 0;
}
