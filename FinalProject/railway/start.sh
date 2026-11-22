#!/usr/bin/env sh
set -eu

# Railway mounts the persistent volume at /app/storage/app.
DB_DATABASE="${DB_DATABASE:-/app/storage/app/pos.sqlite}"
export DB_DATABASE

# Clear any build-time cached config so runtime Railway variables are used.
php artisan optimize:clear

mkdir -p "$(dirname "$DB_DATABASE")" storage/app/public
touch "$DB_DATABASE"

php artisan migrate --force
php artisan db:seed --force
php artisan storage:link --force

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8080}"
