FROM centos:7
MAINTAINER Jose Andrade <jandrade@gmail.com>
EXPOSE 80

# Install dependencies
RUN yum update -y && \
    yum install -y epel-release && \
    rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm && \
    yum install -y httpd php71w php71w-mcrypt php71w-mysql php71w-mbstring php71w-xml php71w-ldap php71w-cli mysql supervisor git && \
    yum -y clean all

# set Apache environment variables
ENV APACHE_LOG_DIR /var/log/httpd
ENV APACHE_DOC_ROOT /var/www/html/public

# forward logs to docker log collector
RUN ln -sf /dev/stdout ${APACHE_LOG_DIR}/access.log && \
    ln -sf /dev/stderr ${APACHE_LOG_DIR}/error.log

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install laravel app
COPY . /var/www/html/
WORKDIR /var/www/html

# Update Laravel packages
RUN /usr/local/bin/composer install --no-scripts --no-dev && \
    /usr/local/bin/composer install --no-dev

# Change permissions for writable folders and change ownership
RUN chmod -R 775 /var/www/html/storage/ && \
    chmod -R 775 /var/www/html/bootstrap/cache && \
    chown -R apache:apache /var/www/html

# Configure apache and laravel queue on supervisor
ADD docker/supervisord.conf /etc/supervisord.conf
ADD docker/httpd.ini /etc/supervisord.d/httpd.ini
ADD docker/apache.conf /etc/httpd/conf.d/apache.conf

# Start supervisor
CMD php artisan key:generate && \
    /usr/bin/supervisord -c /etc/supervisord.conf
