#!/bin/bash

service mariadb start
sed -i 's/MariaDB.*\/false/MariaDB:\/nonexistent:\/bin\/bash/' /etc/passwd
su -c/dbsetup.sh mysql
sed -i 's/MariaDB.*\/bash/MariaDB:\/nonexistent:\/bin\/false/' /etc/passwd
apache2-foreground
