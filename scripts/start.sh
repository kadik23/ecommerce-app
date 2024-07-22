#!/bin/bash

echo "# JWT Secret Generate..."
php artisan jwt:secret

echo "# Link storage..."
php artisan storage:link

echo "# Start the PHP application in the background"
php artisan serve --host=0.0.0.0 --port=8000 &
