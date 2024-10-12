#!/bin/bash

REPOURL=https://github.com/cfthompson/bycBeerCanDB.git

git clone $REPOURL /tmp/mysqlrepo >> /dbsetup.log 2>&1
chown -R mysql:mysql /tmp/mysqlrepo >> /dbsetup.log 2>&1
cd /tmp/mysqlrepo
git config --global safe.directory '*'

service cron start
service mariadb start
sed -i 's/MariaDB.*\/false/MariaDB:\/nonexistent:\/bin\/bash/' /etc/passwd
su -c/dbsetup.sh mysql
sed -i 's/MariaDB.*\/bash/MariaDB:\/nonexistent:\/bin\/false/' /etc/passwd

mv /tmp/.my.cnf /root/.my.cnf
chown root:root /root/.my.cnf
chmod 600 /root/.my.cnf

source /root/.my.cnf 2>/dev/null

MYUSER=$user
MYPW=$password

sed -i "s/'password' =>.*/'password' => '$MYPW',/" /var/www/html/protected/config/main.php
sed -i "s/'username' =>.*/'username' => '$MYUSER',/" /var/www/html/protected/config/main.php

#sed -i "s/'password' => 'byc@1939',/'password' => '${MYPW}',/" /var/www/html/protected/config/main.php
#sed -i "s/'username' => 'byc',/'username' => '${MYUSER}',/" /var/www/html/protected/config/main.php


apache2-foreground
