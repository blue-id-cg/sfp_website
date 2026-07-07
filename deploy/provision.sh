#!/usr/bin/env bash
#
# Provisionnement d'un serveur Ubuntu/Debian VIERGE pour héberger le site SFP.
# À exécuter UNE SEULE FOIS, en tant que root, sur un serveur tout neuf.
#
# Ce script installe et configure : Nginx, PHP-FPM, Composer, Node.js,
# le certificat HTTPS (Let's Encrypt), puis déploie l'application.
#
# Usage :
#   sudo bash provision.sh votre-domaine.com [url-du-depot-git]
#
# Si [url-du-depot-git] n'est pas fourni, le script suppose que les fichiers
# du projet ont déjà été envoyés manuellement (FTP/SCP) dans /var/www/sfp_website.
#
# Voir DEPLOIEMENT.md pour le détail de chaque étape.

set -euo pipefail

DOMAIN="${1:-}"
REPO_URL="${2:-}"
APP_DIR="/var/www/sfp_website"
PHP_VERSION="8.3"

if [ -z "$DOMAIN" ]; then
    echo "Usage : sudo bash provision.sh votre-domaine.com [url-du-depot-git]"
    exit 1
fi

if [ "$(id -u)" -ne 0 ]; then
    echo "Ce script doit être exécuté en root (utilisez : sudo bash provision.sh ...)"
    exit 1
fi

echo "==> [1/9] Mise à jour du système"
apt-get update -y
apt-get upgrade -y

echo "==> [2/9] Installation de Nginx, PHP $PHP_VERSION et des extensions requises"
apt-get install -y software-properties-common curl git unzip ca-certificates gnupg lsb-release
add-apt-repository -y ppa:ondrej/php || true
apt-get update -y
apt-get install -y nginx \
    "php${PHP_VERSION}-fpm" "php${PHP_VERSION}-cli" "php${PHP_VERSION}-mbstring" \
    "php${PHP_VERSION}-xml" "php${PHP_VERSION}-sqlite3" "php${PHP_VERSION}-curl" \
    "php${PHP_VERSION}-zip" "php${PHP_VERSION}-gd" "php${PHP_VERSION}-bcmath"

echo "==> [3/9] Installation de Composer"
if ! command -v composer >/dev/null 2>&1; then
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

echo "==> [4/9] Installation de Node.js 20"
if ! command -v node >/dev/null 2>&1; then
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
    apt-get install -y nodejs
fi

echo "==> [5/9] Récupération des fichiers de l'application"
mkdir -p "$APP_DIR"
if [ -n "$REPO_URL" ]; then
    if [ -d "$APP_DIR/.git" ]; then
        git -C "$APP_DIR" pull
    else
        git clone "$REPO_URL" "$APP_DIR"
    fi
else
    if [ ! -f "$APP_DIR/artisan" ]; then
        echo "ERREUR : aucun dépôt Git fourni et $APP_DIR ne contient pas de projet Laravel."
        echo "Envoyez d'abord les fichiers du projet dans ce dossier (FTP/SCP), puis relancez ce script."
        exit 1
    fi
fi

cd "$APP_DIR"

echo "==> [6/9] Installation des dépendances et compilation des assets"
composer install --optimize-autoloader --no-dev --no-interaction
npm install
npm run build

if [ ! -f .env ]; then
    cp .env.example .env
fi
sed -i "s#^APP_URL=.*#APP_URL=https://${DOMAIN}#" .env
sed -i "s/^APP_ENV=.*/APP_ENV=production/" .env
sed -i "s/^APP_DEBUG=.*/APP_DEBUG=false/" .env

if ! grep -q "^APP_KEY=base64" .env; then
    php artisan key:generate --force
fi

php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> [7/9] Permissions des dossiers writables"
chown -R www-data:www-data "$APP_DIR"
chmod -R 775 "$APP_DIR/storage" "$APP_DIR/bootstrap/cache"

echo "==> [8/9] Configuration du site Nginx"
cat > "/etc/nginx/sites-available/${DOMAIN}" <<NGINX
server {
    listen 80;
    server_name ${DOMAIN} www.${DOMAIN};
    root ${APP_DIR}/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php\$ {
        fastcgi_pass unix:/run/php/php${PHP_VERSION}-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
NGINX

ln -sf "/etc/nginx/sites-available/${DOMAIN}" "/etc/nginx/sites-enabled/${DOMAIN}"
nginx -t
systemctl reload nginx

echo "==> [9/9] Certificat HTTPS (Let's Encrypt)"
apt-get install -y certbot python3-certbot-nginx
echo "Le DNS de ${DOMAIN} doit déjà pointer vers l'IP de ce serveur pour que cette étape réussisse."
certbot --nginx -d "${DOMAIN}" -d "www.${DOMAIN}" --non-interactive --agree-tos -m "contact@snpc-sfp.net" --redirect || \
    echo "AVERTISSEMENT : la génération du certificat HTTPS a échoué (DNS pas encore propagé ?). Relancez plus tard : certbot --nginx -d ${DOMAIN} -d www.${DOMAIN}"

echo ""
echo "=================================================================="
echo " Terminé. Le site devrait être accessible sur https://${DOMAIN}"
echo " Pour les mises à jour futures, utilisez : deploy/deploy.sh"
echo "=================================================================="
