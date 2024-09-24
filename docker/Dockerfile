FROM php:8.1-apache
#FROM php:7.4-apache
#COPY src/yii-1.1.25.43e386.tar.gz /var/www/html

COPY src/minimal_bycresults.sql /tmp/results.sql
COPY src/bootstrap.sh /
COPY src/dbsetup.sh /
COPY src/yii-1.1.29.f89b76.tar.gz /var/www/html
COPY src/50-server.cnf /root/50-server.cnf
COPY src/.htaccess /var/www/html/.htaccess
COPY src/backupDB.sh /root/backupDB.sh
COPY src/backupDB.cron /root/backupDB.cron

RUN apt-get -y update && apt-get -y upgrade
RUN curl -LsS https://r.mariadb.com/downloads/mariadb_repo_setup | bash
RUN apt-get -y install mariadb-server mariadb-client mariadb-backup wget git cron
RUN wget -qO- https://repos-droplet.digitalocean.com/install.sh | bash
RUN rm -f /etc/localtime
RUN ln -s /usr/share/zoneinfo/America/Los_Angeles /etc/localtime

RUN chmod 700 /bootstrap.sh
RUN cat /root/50-server.cnf > /etc/mysql/mariadb.conf.d/50-server.cnf
RUN chown mysql:mysql /dbsetup.sh
RUN chmod 700 /dbsetup.sh
RUN chmod 700 /root/backupDB.sh
#RUN chmod 644 /etc/cron.d/backupDB.cron
RUN crontab -u root /root/backupDB.cron 

WORKDIR /var/www/html
#RUN tar -xzvf yii-1.1.25.43e386.tar.gz
#RUN rm -f yii-1.1.25.43e386.tar.gz
RUN tar -xzvf yii-1.1.29.f89b76.tar.gz
RUN rm -f yii-1.1.29.f89b76.tar.gz

#WORKDIR /var/www/html/yii-1.1.25.43e386/framework
WORKDIR /var/www/html/yii-1.1.29.f89b76/framework
RUN chmod 700 ./yiic
RUN echo yes | ./yiic webapp /var/www/html/

RUN git clone https://github.com/dudonsky/bycResults.git /root/bycResults
RUN rsync -av /root/bycResults/src/* /var/www/html/

#RUN ln -s /var/www/html/yii-1.1.25.43e386/framework/ /var/www/html/protected/framework
#RUN ln -s /var/www/html/yii-1.1.25.43e386/requirements/ /var/www/html/protected/requirements
RUN ln -s /var/www/html/yii-1.1.29.f89b76/framework/ /var/www/html/protected/framework
RUN ln -s /var/www/html/yii-1.1.29.f89b76/requirements/ /var/www/html/protected/requirements

#hack to replace deprectated strftime function
RUN sed -i "s/strftime('%F %T'/date('Y-m-d H:i:s'/" /var/www/html/protected/components/UserIdentity.php
RUN sed -i "s/strftime('%B %e, %Y'/date('F j, Y'/" /var/www/html/protected/controllers/SiteController.php

#localhost doesn't match when mysql connection is made, gotta use 127.0.0.1
RUN sed -i 's/localhost/127.0.0.1/' /var/www/html/protected/config/main.php

#should probably just fix this in the code someday, but for now...
RUN sed -i 's/sailresults/berkele6_results/' /var/www/html/protected/config/main.php

#make sure we're not using sqllite
RUN rm -f /var/www/html/protected/config/database.php

RUN chown -R www-data:www-data /var/www/html/
RUN a2enmod rewrite
#RUN sed -i 's/AllowOverride\ None/AllowOverride\ All/' /etc/apache2/apache2.conf
RUN ln -s /var/www/html/php.ini /usr/local/etc/php/php.ini
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd
RUN docker-php-ext-install pdo pdo_mysql

COPY src/gitconfig /root/.gitconfig
COPY src/gitcreds /root/.git-credentials
RUN chmod 640 /root/.git-credentials /root/.gitconfig

EXPOSE 80

WORKDIR /var/www/html
CMD [ "/bootstrap.sh" ]
