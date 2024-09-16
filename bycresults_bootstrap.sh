#!/bin/bash

# Replace the commands in these variables with commands to fetch the DB dump, yii framework, and code 
# from an appropriate location (these are private buckets)
FETCH_DB="aws s3 cp s3://bycresults/sailresults.sql ."
#FETCH_YII="aws s3 cp s3://bycresults/yii-1.1.25.43e386.tar.gz ."
FETCH_YII="wget https://github.com/yiisoft/yii/releases/download/1.1.29/yii-1.1.29.f89b76.tar.gz"

# This repo may change while we attempt an upgrade to PHP 8 and YII 2.0.  Ideally we'll fork the repo,
# do the work, and submit a pull request to the upstream repo, but we'll see.
FETCH_PROG="git clone https://github.com/dudonsky/bycResults.git"


yum update -y
yum install -y httpd php php-mysql php-pdo php-mbstring.x86_64 gzip git mariadb-server
systemctl start mariadb

# php and/or yii get upset if the timezone isn't set in php.ini
sed -i 's/\[Date\]//' /etc/php.ini
echo "[Date]" >> /etc/php.ini
echo "date.timezone = UTC" >> /etc/php.ini

####################################################################################
# DB Setup:                                                                        #
#                                                                                  #
#  The commands below work with the default values in config/main.php from the     #
#   github project, but don't use these on your live site. Use a real database     #
#   dump, database name, username, and password (and perhaps a host other than     #
#   "localhost", and modify these commands accordingly.                            #
####################################################################################

$FETCH_DB
mysql < ./sailresults.sql
mysql -e "create user 'byc'@'localhost';"
mysql -e "set password for 'byc'@'localhost' = PASSWORD('byc@1939');"
mysql -e "grant all on sailresults.* to 'byc'@'localhost';"
mysql -e "flush privileges;"

# download yii framework (this bucket is private, best to fetch it from:
# https://github.com/yiisoft/yii/releases/download/1.1.25/yii-1.1.25.43e386.tar.gz
cd /var/www/html
$FETCH_YII
tar -xzvf yii-1.1.25.43e386.tar.gz
          

cd /var/www/html/yii-1.1.25.43e386/framework/
echo yes | ./yiic webapp /var/www/html/bycresults
cd /var/www/html/
$FETCH_PROG

rsync -av bycResults/src/ bycresults/

ln -s /var/www/html/yii-1.1.25.43e386/framework/ /var/www/html/bycresults/protected/framework
ln -s /var/www/html/yii-1.1.25.43e386/requirements/ /var/www/html/bycresults/protected/requirements

rm -f /var/www/html/bycresults/protected/config/database.php

#you only really need to do this in the directories where yii is running, but this file isn't easy to change with a bash one-liner.  Probably ought to be more careful about that in production.
sed -i 's/AllowOverride\ None/AllowOverride\ All/' /etc/httpd/conf/httpd.conf

#a2enmod rewrite
systemctl restart httpd
