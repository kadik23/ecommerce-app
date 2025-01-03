#!/bin/bash

echo "# Generating JWT secret..."
php artisan jwt:secret

echo "# Linking storage..."
php artisan storage:link

echo "# Starting the PHP application..."
php artisan serve --host=0.0.0.0 --port=8000
