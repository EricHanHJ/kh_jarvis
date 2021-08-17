#include <stdio.h>
#include <string.h>

int main()
{
        setuid(0);
        system("portsentry -stcp");
        system("portsentry -sudp");


        return 0;
}
