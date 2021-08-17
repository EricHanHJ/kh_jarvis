#! /bin/bash


# Reset Rules
iptables -F
iptables -Z

# Basic Policy
iptables -P INPUT DROP
iptables -P FORWARD ACCEPT
iptables -P OUTPUT DROP

# Localhost
iptables -A INPUT -i lo -j ACCEPT

# Established And Related Connection Access
iptables -A INPUT -m state --state ESTABLISHED,RELATED -j ACCEPT

# INVALID
iptables -t filter -A INPUT -m state --state INVALID -j DROP

# TCP SSH, TCP HTTP Access
iptables -A INPUT -i eth0 -p tcp -s 0.0.0.0/0 -d 0.0.0.0/0 --sport 1:65535 --dport 22 -j ACCEPT
iptables -A INPUT -i eth0 -p tcp -s 0.0.0.0/0 -d 0.0.0.0/0 --sport 1:65535 --dport 80 -j ACCEPT
iptables -A OUTPUT -o eth0 -p tcp -s 0.0.0.0/0 -d 0.0.0.0/0 --sport 22 --dport 1:65535 -j ACCEPT
iptables -A OUTPUT -o eth0 -p tcp -s 0.0.0.0/0 -d 0.0.0.0/0 --sport 80 --dport 1:65535 -j ACCEPT
iptables -A INPUT -i eth0 -p tcp -s 0.0.0.0/0 -d 0.0.0.0/0 --sport 1:65535 --dport 8080 -j ACCEPT
iptables -A OUTPUT -o eth0 -p tcp -s 0.0.0.0/0 -d 0.0.0.0/0 --sport 8080 --dport 1:65535 -j ACCEPT




# Save Policy
/sbin/service iptables save

# Iptabels Restart
service iptables restart
