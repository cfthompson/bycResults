#!/bin/bash

DATE=`date '+%Y-%m-%d'`
cd /tmp/mysqlrepo
git pull
#mysqldump -h127.0.0.1 -ubyc -pbyc@1939 berkele6_results > /tmp/mysqlrepo/berkele6_results.sql
mysqldump -h127.0.0.1 berkele6_results > /tmp/mysqlrepo/berkele6_results.sql
git commit -a -m "$DATE beercan results DB backup"
git push
