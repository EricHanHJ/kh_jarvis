#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include "/usr/include/mysql/mysql.h"

#define DB_HOST "127.0.0.1"
#define DB_USER "root"
#define DB_PASS "qwer1234"
#define DB_NAME "Avengers"

void input_mysql(char *year, char *month, char *date, char *full_time, char *msg);
void change_month(int month, char *output);
int main()
{
        FILE* fr = NULL;
        char *line = NULL;
        size_t len = 0;
        ssize_t read;

        char *sp, *dp, *ddp;
	char mydata[25] = {0x00,};

	char year[5];
        char month[4];
        char date[3];
        char full_time[9];
        char msg[400];

        char temp_year[5];
        char temp_month[4];
        char temp_date[3];
        int i;

        time_t now = time(NULL);
        struct tm *lt = localtime(&now);
        //printf("%d년 %d월 %d일 %d시 %d분",lt->tm_year+1900, lt->tm_mon+1, lt->tm_mday, lt->tm_hour+1, lt->tm_min+1);

        setuid(0);
	fr=fopen("/var/log/messages","r");
	if(fr==NULL)
		exit(EXIT_FAILURE);
	while((read=getline(&line, &len, fr)) != -1){
		sp=index(line, ':');
		dp=index(line, ':');
		strncpy(mydata, line, 25);
		mydata[15]='\0';
		strncpy(msg,dp+7, dp-sp+400); 

		year[0]='2';
                year[1]='0';
                year[2]='1';
                year[3]='5';
                year[4]='\0';
                month[0]=mydata[0];
                month[1]=mydata[1];
                month[2]=mydata[2];
                month[3]='\0';
                date[0]=mydata[4];
                date[1]=mydata[5];
                date[2]='\0';
		if(date[0]==' ') date[0]='0';
                for(i=0; i<8; i++)      full_time[i]=mydata[7+i];
                full_time[8]='\0';
		
		change_month(lt->tm_mon+1,temp_month);

                snprintf(temp_year, sizeof(temp_year), "%d", lt->tm_year+1900);
                snprintf(temp_date, sizeof(temp_date), "%d", lt->tm_mday);
 //               if( !strcmp(year, temp_year) && !strcmp(month, temp_month) && !strcmp(date, temp_date))
                        input_mysql(year, month, date, full_time, msg);
        }
        free(line);
        fclose(fr);
}
void change_month(int month, char *output){
        char temp[4];
        switch(month){
                case 1 : strcpy(temp, "Jan"); break;
                case 2 : strcpy(temp, "Feb"); break;
                case 3 : strcpy(temp, "Mar"); break;
                case 4 : strcpy(temp, "Apr"); break;
                case 5 : strcpy(temp, "May"); break;
                case 6 : strcpy(temp, "Jun"); break;
                case 7 : strcpy(temp, "Jul"); break;
                case 8 : strcpy(temp, "Aug"); break;
                case 9 : strcpy(temp, "Sep"); break;
                case 10 : strcpy(temp, "Oct"); break;
                case 11 : strcpy(temp, "Nov"); break;
                case 12 : strcpy(temp, "Dec"); break;
                default : printf("error"); break;
        }
        strcpy(output, temp);
}
void input_mysql(char *year, char *month, char *date, char *full_time, char *msg){
        MYSQL       *connection=NULL, conn;
        MYSQL_RES   *sql_result;
        MYSQL_ROW   sql_row;
        int       query_stat;
        char query[400];
        mysql_init(&conn);

        connection = mysql_real_connect(&conn, DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306, (char *)NULL, 0);
        if (connection == NULL) fprintf(stderr, "Mysql connection error : %s\n", mysql_error(&conn));

        sprintf(query, "insert into messages_log values('%s', '%s', '%s', '%s','%s')", year, month, date, full_time, msg);
        query_stat = mysql_query(connection, query);
        if (query_stat != 0)    fprintf(stderr, "Mysql query error : %s\n", mysql_error(&conn));

        mysql_close(connection);
}

