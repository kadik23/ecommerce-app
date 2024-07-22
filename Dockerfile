FROM php:8.2-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev libpq-dev unzip nodejs npm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_pgsql

WORKDIR /app
COPY . /app
COPY .env.example /app/.env
# Set environment variables
ENV APP_KEY=base64:yourgeneratedkeyhere
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV DB_CONNECTION=pgsql
ENV DB_HOST=dpg-cqegneogph6c73aor3k0-a
ENV DB_PORT=5432
ENV DB_DATABASE=ecommercedbapp
ENV DB_USERNAME=root
ENV DB_PASSWORD=t1tEFC9rIE5hoblMKYw6KJDmlr1qmXxu
ENV DB_SSLMODE=require
RUN composer install

RUN php artisan migrate:fresh
RUN php artisan db:seed

ENV PORT 4173 
EXPOSE 4173

RUN chmod +x ./scripts/start.sh

CMD ["sh","./scripts/start.sh"]
