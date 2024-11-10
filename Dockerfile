# Use the official PHP with Apache image
FROM php:apache

# Install required dependencies for mysqli
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev

# Install PHP extensions, including mysqli
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80 for web access
EXPOSE 80
