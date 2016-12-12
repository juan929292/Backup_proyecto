!/bin/bash

#-s Especifica una dirección de origen
#-d Especifica una dirección de destino
#-p Especifica un prototocolo
#-i Especifica un interface de entrada
#-o Especifica un interface de salida
#-j Especifica la acción a ejecutar sobre el paquete
#--sport Puerto de origen
#--dport Puerto de destino

echo 1 > /proc/sys/net/ipv4/if_forward
route add –net 10.77.0.0 netmask 255.255.255.224 gw 192.160.1.1
route add default gw 192.168.1.1
iptables -A OUTPUT -o eth0 -p tcp --sport 22 -m state --state ESTABLISHED -j ACCEPT
iptables -A OUTPUT -o eth0 -p tcp --sport 80 -m state --state ESTABLISHED -j ACCEPT
iptables -A INPUT -i eth0 -p tcp --sport 443 -m state --state ESTABLISHED -j ACCEPT
iptables -A OUTPUT -p icmp --icmp-type echo-request -j ACCEPT