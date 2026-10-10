#!/bin/bash
set -e

echo "# Ensuring storage and cache permissions..."
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache/data storage/logs bootstrap/cache
chmod -R 777 storage bootstrap/cache 2>/dev/null || true

echo "# Syncing Render environment variables into .env..."
php -r '
$envFile = ".env";
$lines = file_exists($envFile) ? file($envFile, FILE_IGNORE_NEW_LINES) : [];
$keys = [];
foreach ($lines as $i => $line) {
    $trimmed = trim($line);
    if ($trimmed === "" || strpos($trimmed, "#") === 0 || !str_contains($line, "=")) continue;
    [$key] = explode("=", $line, 2);
    $keys[trim($key)] = $i;
}
foreach ($_SERVER as $k => $v) {
    if ($v === "" || !is_string($v) || preg_match("/[^A-Za-z0-9_]/", $k)) continue;
    if (isset($keys[$k])) {
        $lines[$keys[$k]] = "$k=$v";
    } else {
        $lines[] = "$k=$v";
    }
}
file_put_contents($envFile, implode("\n", $lines) . "\n");
' 2>/dev/null || true

if [ -z "$APP_KEY" ]; then
    echo "# Generating APP key..."
    php artisan key:generate --force
fi

echo "# Linking storage..."
php artisan storage:link 2>/dev/null || true

echo "# Clearing stale cached configurations..."
php artisan config:clear || true

echo "# Running database migrations..."
php artisan migrate --force

if [ "$SEED_DATABASE" = "true" ] || [ "$RUN_SEEDERS" = "true" ]; then
    echo "# Seeding database..."
    php artisan db:seed --force
fi

echo "# Starting the PHP application..."
php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
