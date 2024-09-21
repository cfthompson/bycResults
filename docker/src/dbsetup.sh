#!/bin/bash

#don't use a $ sign in the password.  Hard to escape those.
#You probably also want to change this from the default values, both in the PHP code and the DB.

mysql -e "use berkele6_results;"
if [ "$?" != "0" ]; then

  MYUSER="byc"
  MYPW="byc@1939"

  mysql -e "create database \`berkele6_results\`;"
  mysql -D berkele6_results < /tmp/mysqlrepo/berkele6_results.sql
  mysql -e "create user '${MYUSER}'@'127.0.0.1';"
  #don't use a $ sign in the password.  Hard to escape those.
  mysql -e "set password for '${MYUSER}'@'127.0.0.1' = PASSWORD('${MYPW}');"
  mysql -e "set password for '${MYUSER}'@'localhost' = PASSWORD('${MYPW}');"
  mysql -e "grant all on berkele6_results.* to '${MYUSER}'@'127.0.0.1';"
  mysql -e "grant all on berkele6_results.* to '${MYUSER}'@'localhost';"
  mysql -e "flush privileges;"
fi
echo "Now go change the 'db'=>array() block in /var/www/html/protected/config/main.php to reflect this uername and password."
