FROM php:8.2-apache
COPY . /var/www/html/
RUN chown www-data:www-data /var/www/html/database.sqlite /var/www/html/uploads
EXPOSE 80
