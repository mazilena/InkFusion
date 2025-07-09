# Use official PHP image with Apache
FROM php:8.1-apache

# Enable Apache rewrite module (if you plan to use .htaccess)
RUN a2enmod rewrite

# Copy all project files to the web server root
COPY . /var/www/html/

# Give proper permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
