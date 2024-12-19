FROM php:8.1-cli

# Install required PHP extensions
RUN apt-get update -y && apt-get install -y libpq-dev unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_pgsql

# Set the working directory
WORKDIR /app
COPY . /app
COPY .env.example /app/.env

# Install PHP dependencies
RUN composer install

# Laravel setup commands
RUN php artisan key:generate
RUN php artisan migrate:fresh
RUN php artisan db:seed

# Expose the Laravel port
ENV PORT 8000
EXPOSE 8000

# Grant execute permission to the start script
RUN chmod +x ./scripts/start.sh

# Start the Laravel application
CMD ["sh", "./scripts/start.sh"]
