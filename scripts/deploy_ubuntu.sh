#!/bin/bash
set -eo pipefail

APP_PATH="/var/www/uniprephub"
NGINX_CONF="/etc/nginx/sites-available/uniprephub"
REPO_URL="https://github.com/shaistaanjumsh-maker/uniprephub.git"

echo "Deploying UniPrepHub to Ubuntu VPS..."

sudo apt-get update
sudo apt-get install -y nginx git curl unzip

if ! command -v docker >/dev/null 2>&1; then
  curl -fsSL https://get.docker.com | sudo bash
fi
if ! command -v docker-compose >/dev/null 2>&1; then
  sudo apt-get install -y docker-compose-plugin
fi

sudo mkdir -p "$APP_PATH"
sudo chown "$USER":"$USER" "$APP_PATH"

if [ ! -d "$APP_PATH/.git" ]; then
  git clone "$REPO_URL" "$APP_PATH"
else
  cd "$APP_PATH"
  git fetch --all
  git reset --hard origin/main
fi

cd "$APP_PATH"
cp .env.production .env
sed -i "s|APP_URL=.*|APP_URL=https://your-domain.com|" .env
sed -i "s|DB_HOST=.*|DB_HOST=db|" .env
sed -i "s|DB_DATABASE=.*|DB_DATABASE=uniprephub|" .env
sed -i "s|DB_USERNAME=.*|DB_USERNAME=uniprephub_user|" .env
sed -i "s|DB_PASSWORD=.*|DB_PASSWORD=ReplaceSecurePassword|" .env
sed -i "s|APP_KEY=.*|APP_KEY=$(php -r 'require "vendor/autoload.php"; echo base64_encode(random_bytes(32));')|" .env

sudo cp nginx.conf "$NGINX_CONF"
sudo ln -sf "$NGINX_CONF" /etc/nginx/sites-enabled/uniprephub
sudo rm -f /etc/nginx/sites-enabled/default

sudo docker compose down || true
sudo docker compose up -d --build

sudo nginx -t
sudo systemctl restart nginx

sudo docker compose exec app php artisan migrate --force
sudo docker compose exec app php artisan db:seed --force
sudo docker compose exec app php artisan storage:link
sudo docker compose exec app php artisan optimize:clear
sudo docker compose exec app php artisan config:cache
sudo docker compose exec app php artisan route:cache
sudo docker compose exec app php artisan view:cache

echo "Deployment complete. Visit https://your-domain.com"
