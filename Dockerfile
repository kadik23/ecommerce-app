FROM php:8.1-cli

# Install required PHP extensions & Node.js
RUN apt-get update -y && apt-get install -y \
    libmcrypt-dev \
    libpq-dev \
    unzip \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_pgsql

# Set the working directory
WORKDIR /app

# Copy application files (excluding files in .dockerignore)
COPY . /app
COPY .env.example /app/.env

# Install PHP dependencies (production optimized)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node dependencies & build frontend assets during image build
RUN npm install
RUN npm run build
RUN rm -rf node_modules

# Laravel setup commands
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache
RUN php artisan key:generate

# Expose the Laravel port
ENV PORT 8000
EXPOSE 8000

# Grant execute permission to the start script
RUN chmod +x ./scripts/start.sh

# Start the Laravel application
CMD ["sh", "./scripts/start.sh"]
