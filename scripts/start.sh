#!/bin/bash
set -e

if [ -z "$APP_KEY" ]; then
    echo "# Generating APP key..."
    php artisan key:generate --force
fi

echo "# Linking storage..."
php artisan storage:link

echo "# Running database migrations..."
php artisan migrate --force

if [ "$SEED_DATABASE" = "true" ] || [ "$RUN_SEEDERS" = "true" ]; then
    echo "# Seeding database..."
    php artisan db:seed --force
fi

echo "# Starting the PHP application..."
php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
