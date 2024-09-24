#!/bin/bash

#don't use a $ sign in the password.  Hard to escape those.
#You probably want to change these default values, but when you do, I would suggest you do not check this file back into git.  Otherwise your database creds could get exposed if and when you push it back to github.  Unfortunately, there is no secrets management service in Digital Ocean to leverage for this.

MYUSER="results"
MYPW="letMe1nDamnit"

mysql -e "create database \`berkele6_results\`;"
mysql -D berkele6_results < /tmp/mysqlrepo/berkele6_results.sql
mysql -e "create user '${MYUSER}'@'127.0.0.1';"
mysql -e "set password for '${MYUSER}'@'127.0.0.1' = PASSWORD('${MYPW}');"
mysql -e "set password for '${MYUSER}'@'localhost' = PASSWORD('${MYPW}');"
mysql -e "grant all on berkele6_results.* to '${MYUSER}'@'127.0.0.1';"
mysql -e "grant all on berkele6_results.* to '${MYUSER}'@'localhost';"
mysql -e "SET GLOBAL SQL_MODE='ALLOW_INVALID_DATES'"
mysql -e "flush privileges;"

cat <<EOF > /tmp/.my.cnf
[client]
user=${MYUSER}
password=${MYPW}
EOF
