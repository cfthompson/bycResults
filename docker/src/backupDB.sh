#!/bin/bash

DATE=`date '+%Y-%m-%d'`
cd /tmp/mysqlrepo
git pull
mysqldump -ubyc -pbyc@1939 berkele6_results > /tmp/mysqlrepo/berkele6_results.sql
git commit -a -m "$DATE beercan results DB backup"
git push
