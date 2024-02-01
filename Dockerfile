FROM php:7.4-apache

# Update APT and install required packages
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        zip \
        unzip \
        libzip-dev \
        default-mysql-client \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Apache document root
ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer.json and composer.lock
COPY composer.json composer.lock /var/www/html/

# Install Composer dependencies (without running scripts to avoid database connection issues)
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application
COPY . /var/www/html/

# Finish Composer installation
RUN composer dump-autoload --optimize

# Expose MySQL port
EXPOSE 8000

# Start Apache
CMD ["php -S localhost:8000"]
