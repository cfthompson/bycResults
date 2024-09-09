FROM php:8.1-apache
#FROM php:7.4-apache

#COPY src/results.sql /root/results.sql
COPY src/minimal_bycresults.sql /tmp/results.sql
COPY src/bootstrap.sh /
COPY src/dbsetup.sh /root/
#COPY src/yii-1.1.25.43e386.tar.gz /var/www/html
COPY src/yii-1.1.29.f89b76.tar.gz /var/www/html
COPY src/50-server.cnf /root/50-server.cnf
COPY src/.htaccess /var/www/html/.htaccess

RUN apt-get -y update && apt-get -y upgrade
RUN curl -LsS https://r.mariadb.com/downloads/mariadb_repo_setup | bash
RUN apt-get -y install mariadb-server mariadb-client mariadb-backup wget git
RUN wget -qO- https://repos-droplet.digitalocean.com/install.sh | bash

RUN chmod 700 /bootstrap.sh /root/dbsetup.sh
RUN cat /root/50-server.cnf > /etc/mysql/mariadb.conf.d/50-server.cnf

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

RUN sed -i 's/localhost/127.0.0.1/' /var/www/html/protected/config/main.php
RUN sed -i 's/sailresults/berkele6_results/' /var/www/html/protected/config/main.php
RUN rm -f /var/www/html/protected/config/database.php
RUN chown -R www-data:www-data /var/www/html/
RUN a2enmod rewrite
#RUN sed -i 's/AllowOverride\ None/AllowOverride\ All/' /etc/apache2/apache2.conf
RUN ln -s /var/www/html/php.ini /usr/local/etc/php/php.ini
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd
RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 80
#EXPOSE 443

WORKDIR /var/www/html
CMD [ "/bootstrap.sh" ]
