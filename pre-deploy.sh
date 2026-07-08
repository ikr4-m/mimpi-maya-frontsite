#!/usr/bin/env bash
set -euo pipefail

php artisan migrate

php artisan permission:cache-reset
php artisan cache:clear
php artisan optimize:clear

php artisan optimize
php artisan view:cache
php artisan event:cache
composer dump-autoload -o

php artisan filament:upgrade
