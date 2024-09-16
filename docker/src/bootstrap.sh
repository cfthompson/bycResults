#!/bin/bash

service mariadb start
sed -i 's/MariaDB.*\/false/MariaDB:\/nonexistent:\/bin\/bash/' /etc/passwd
su -c/dbsetup.sh mysql
apache2-foreground
