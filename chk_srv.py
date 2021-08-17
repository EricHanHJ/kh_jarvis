#!/usr/bin/python
#This Python file uses the following encoding: utf-8

import sys

fr=open("/var/www/html/kh/chk_srv_temp","r")

while 1:
	line = fr.readline()



	if line.count('정지') == 1:
		print "stop";
		break;
	elif line.count('종료') == 1:
		print "stop";
		break;
	elif line.count('비활성') == 1:
		print "stop";
		break;
	elif line.count('않') == 1:
		print "stop";
		break;
	elif line.count('not') == 1:
		print "stop";
		break;

	else:
		print "run";
		break;

	
fr.close()
