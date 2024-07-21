#!/bin/bash

cd frontend

echo "# Installing dependencies..."
npm install

echo "# Building..."
npm run build

cd ../

echo "# JWT Secret Generate..."
php artisan jwt:secret

echo "# Link storage..."
php artisan storage:link

echo "# Start the PHP application in the background"
php artisan serve --host=0.0.0.0 --port=8000 &


cd frontend

echo "# Start the Node.js application concurrently"
npm run preview