#!/bin/bash

service mariadb start
mysql -e "use berkele6_results;"
if [ "$?" != "0" ]; then
  /root/dbsetup.sh
fi

apache2-foreground
