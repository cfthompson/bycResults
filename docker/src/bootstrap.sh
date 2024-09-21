#!/bin/bash

REPOURL=https://github.com/cfthompson/bycBeerCanDB.git

git clone $REPOURL /tmp/mysqlrepo >> /dbsetup.log 2>&1
chown -R mysql:mysql /tmp/mysqlrepo >> /dbsetup.log 2>&1

service mariadb start
sed -i 's/MariaDB.*\/false/MariaDB:\/nonexistent:\/bin\/bash/' /etc/passwd
su -c/dbsetup.sh mysql
sed -i 's/MariaDB.*\/bash/MariaDB:\/nonexistent:\/bin\/false/' /etc/passwd
apache2-foreground
