#!/usr/bin/env bash
set -euo pipefail

echo "Sourcing .env..."
set -a
source .env
set +a

echo "Checking dependencies..."
if [ ! -d "./node_modules" ]; then
    echo 'Please execute "npm ci" before running this script'
    exit 67
fi
if [ ! -d "./vendor" ]; then
    echo 'Please execute "composer install" before running this script'
    exit 67
fi

echo "laravel: Run first time script"
php artisan optimize:clear
php artisan config:clear
php artisan migrate
php artisan filament:upgrade
php artisan config:cache

# Enable this if needs
#php artisan vendor:publish --tag="wireui.phosphoricons.config"
#php artisan vendor:publish --tag="wireui.phosphoricons.views"
#php artisan vendor:publish --tag="filament-shield-config"
#php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --no-interaction
#php artisan vendor:publish --tag=filament-shield-config --no-interaction

echo "laravel:filament: Generate shield resource for panel"
php artisan shield:generate --all --panel=admin --option=policies_and_permissions

SESSION="mm-fullstack"
echo "tmux: Checking for existing tmux session for $SESSION..."
tmux has-session -t "$SESSION" 2>/dev/null && tmux kill-session -t "$SESSION"

echo "tmux: Setup tmux environment..."
tmux new-session -d -s "$SESSION" -n "dev"
tmux split-window -h -t "$SESSION:dev.0"

echo "tmux: Setting session to auto-close when any pane exits..."
tmux set-hook -t "$SESSION" pane-exited "kill-session -t $SESSION"

echo "tmux: Starting Laravel Artisan pane..."
tmux send-keys -t "$SESSION:dev.0" 'php artisan serve --host 0.0.0.0' C-m

NODE_RUNTIME=${NODE_RUNTIME:-bun}
echo "tmux: Starting Vite pane with bun..."
tmux send-keys -t "$SESSION:dev.1" "$NODE_RUNTIME run dev" C-m

echo "tmux: Attaching to tmux session '$SESSION'..."
tmux attach -t "$SESSION"
