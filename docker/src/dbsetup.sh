#!/bin/bash

echo "Pretty please, with sugar on it, change this username and password for the database connection.  Don't use these values, which are published on github for everyone to see."

MYUSER="byc"
MYPW="byc@1939"

#ONLY RUN THIS STUFF IF YOU NEED TO RESTORE THE DATABASE
mysql -e "create database \`berkele6_results\`;"
mysql -D berkele6_results < /tmp/results.sql
mysql -e "create user '${MYUSER}'@'127.0.0.1';"
#need to escape this $ sign somehow...
mysql -e "set password for '${MYUSER}'@'127.0.0.1' = PASSWORD('${MYPW}');"
mysql -e "grant all on berkele6_results.* to '${MYUSER}'@'127.0.0.1';"
mysql -e "flush privileges;"

echo "Now go change the 'db'=>array() block in /var/www/html/protected/config/main.php to reflect this uername and password.
