#!/usr/bin/env bash
set -euo pipefail

php artisan migrate

php artisan optimize:clear
php artisan optimize
php artisan permission:cache-reset

composer dump-autoload -o

# Generate when create new resource
#php artisan shield:generate --all --panel=admin --option=policies_and_permissions

# For upgrading filament
#php artisan filament:upgrade
