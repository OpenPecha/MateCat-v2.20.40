FROM ubuntu/apache2:2.4-22.04_beta

RUN apt-get -y update

RUN apt-get -y install software-properties-common

RUN add-apt-repository -y ppa:ondrej/php && \
    add-apt-repository -y ppa:ondrej/apache2

RUN  apt-get -y --fix-missing install libapache2-mod-php5.6 \
        php5.6 php5.6-json php5.6-curl php5.6-mysql php5.6-xml php5.6-mbstring php5.6-dev php5.6-mcrypt php5.6-redis \
        php5.6-zip

RUN a2enmod rewrite filter deflate headers expires proxy_http ssl php5.6 &&\
    phpenmod mcrypt

RUN echo "short_open_tag = On" >> /etc/php/5.6/cli/php.ini && \
    echo "memory_limit = 1024M" >> /etc/php/5.6/cli/php.ini && \
    echo "magic_quotes_runtime = Off" >> /etc/php/5.6/cli/php.ini && \
    echo "magic_quotes_runtime = Off" >> /etc/php/5.6/apache2/php.ini 

RUN openssl req -x509 -newkey rsa:4096 -keyout my_matecat.key -out my_matecat.crt -days 365 -nodes -subj "/C=DE/O=Cerence/OU=Coretech/CN=*.coretech.cerence.net" && \
    mkdir /etc/apache2/ssl-cert && \
    mv my_matecat.* /etc/apache2/ssl-cert/ 

RUN apt-get -y install git 

COPY ../../.. /app/matecat

#RUN git clone --branch v2.20.40 --depth 1  https://github.com/matecat/MateCat.git /app/matecat && \
RUN cd /app/matecat/  && \
    php -r "readfile('https://getcomposer.org/installer');" | php && \
    php composer.phar --no-dev install

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    apt-get -y update && \
    apt-get -y install yarn

#COPY ./matecat-conf/*.ini /app/matecat/inc/

WORKDIR /app/matecat
RUN yarn global add grunt-cli && \
    yarn install && \
    grunt deploy

RUN rm -rf /etc/apache2/sites-available/* 
COPY ./conf/*.conf /etc/apache2/sites-available/
RUN a2ensite default-vhost.conf && \
    a2ensite 443-matecat.conf    

# for daemons
RUN apt-get -y install screen sudo

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
RUN touch /app/matecat/inc/login_secret.dat
RUN chown -R www-data:www-data /app/matecat/
COPY --chmod=0755 ./start.sh /

CMD ["/bin/bash", "-c", "/start.sh"]
