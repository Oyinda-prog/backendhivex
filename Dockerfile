FROM php:8.3-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

COPY . .

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache

RUN a2enmod rewrite

# Change Apache DocumentRoot to Laravel public folder
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' \
    /etc/apache2/sites-available/000-default.conf

# Allow .htaccess
RUN printf '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n' >> /etc/apache2/apache2.conf

COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]
