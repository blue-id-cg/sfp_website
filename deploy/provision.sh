#!/usr/bin/env bash
#
# Provisionnement d'un serveur Ubuntu/Debian VIERGE pour héberger le site SFP.
# À exécuter UNE SEULE FOIS, en tant que root, sur un serveur tout neuf.
#
# Ce script installe et configure : Nginx, PHP-FPM, Composer, Node.js, la base
# de données (SQLite, MySQL, MariaDB ou PostgreSQL), le certificat HTTPS
# (Let's Encrypt), puis déploie l'application.
#
# Nécessite les fichiers voisins deploy/lib.sh, deploy/db.sh et
# deploy/laravel.sh : exécutez-le depuis une copie complète du projet, pas en
# copiant provision.sh isolément.
#
# Usage :
#   sudo bash provision.sh votre-domaine.com [url-du-depot-git]
#
# Si [url-du-depot-git] n'est pas fourni, le script suppose que les fichiers
# du projet ont déjà été envoyés manuellement (FTP/SCP) dans /var/www/sfp_website.
#
# Choix de la base de données (variable d'environnement DB_ENGINE, optionnelle) :
#   DB_ENGINE=sqlite    (par défaut) — un simple fichier, aucune installation.
#   DB_ENGINE=mysql     — installe et configure MySQL sur ce serveur.
#   DB_ENGINE=mariadb   — installe et configure MariaDB sur ce serveur.
#   DB_ENGINE=pgsql     — installe et configure PostgreSQL sur ce serveur.
#
#   Exemple :
#     sudo DB_ENGINE=mysql bash provision.sh votre-domaine.com
#
#   Sur une ré-exécution du script, si DB_ENGINE n'est pas précisé, le moteur
#   déjà configuré dans le .env existant est conservé (au lieu de revenir à
#   sqlite par défaut).
#
# Pour utiliser une base de données déjà existante (ex. un service managé
# externe comme AWS RDS, DigitalOcean Managed Database, etc.), fournissez ses
# identifiants et le script n'installera rien localement, il se contentera de
# configurer l'application pour s'y connecter :
#     sudo DB_ENGINE=pgsql \
#          DB_HOST=db.mon-hebergeur.com DB_PORT=5432 \
#          DB_DATABASE=sfp DB_USERNAME=sfp DB_PASSWORD='...' \
#          bash provision.sh votre-domaine.com
#
# Voir DEPLOIEMENT.md pour le détail de chaque étape.

set -euo pipefail

DOMAIN="${1:-}"
REPO_URL="${2:-}"
APP_DIR="/var/www/sfp_website"
PHP_VERSION="8.3"

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
source "${SCRIPT_DIR}/lib.sh"
source "${SCRIPT_DIR}/db.sh"
source "${SCRIPT_DIR}/laravel.sh"

DB_ENGINE="${DB_ENGINE:-}"
DB_HOST="${DB_HOST:-}"
DB_PORT="${DB_PORT:-}"
DB_DATABASE="${DB_DATABASE:-}"
DB_USERNAME="${DB_USERNAME:-}"
DB_PASSWORD="${DB_PASSWORD:-}"
LETSENCRYPT_EMAIL="${LETSENCRYPT_EMAIL:-contact@snpc-sfp.net}"

TOTAL_STEPS=12
STEP=0

if [ -z "$DOMAIN" ]; then
    echo "Usage : sudo bash provision.sh votre-domaine.com [url-du-depot-git]"
    exit 1
fi

if [ "$(id -u)" -ne 0 ]; then
    echo "Ce script doit être exécuté en root (utilisez : sudo bash provision.sh ...)"
    exit 1
fi

if [ -n "$DB_ENGINE" ]; then
    validate_db_engine "$DB_ENGINE"
fi

resolve_db_external

step "Mise à jour du système"
apt-get update -y
apt-get upgrade -y

step "Installation de Nginx, PHP ${PHP_VERSION} et des extensions requises"
apt-get install -y software-properties-common curl git unzip ca-certificates gnupg lsb-release
add-apt-repository -y ppa:ondrej/php || true
apt-get update -y
apt-get install -y nginx \
    "php${PHP_VERSION}-fpm" "php${PHP_VERSION}-cli" "php${PHP_VERSION}-mbstring" \
    "php${PHP_VERSION}-xml" "php${PHP_VERSION}-sqlite3" "php${PHP_VERSION}-curl" \
    "php${PHP_VERSION}-zip" "php${PHP_VERSION}-gd" "php${PHP_VERSION}-bcmath"

step "Installation de Composer"
if ! command -v composer >/dev/null 2>&1; then
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
fi

step "Installation de Node.js 20"
if ! command -v node >/dev/null 2>&1; then
    curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
    apt-get install -y nodejs
fi

step "Récupération des fichiers de l'application"
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

if [ ! -f .env ]; then
    cp .env.example .env
fi

# Si DB_ENGINE n'est pas fourni, on réutilise le moteur déjà configuré dans le
# .env existant (ré-exécution du script sur un serveur déjà provisionné),
# sinon SQLite par défaut.
DB_ENGINE="${DB_ENGINE:-$(get_env DB_CONNECTION)}"
DB_ENGINE="${DB_ENGINE:-sqlite}"
validate_db_engine "$DB_ENGINE"

step "Base de données (${DB_ENGINE})"
db_provision

if [ "$DB_ENGINE" != "sqlite" ]; then
    systemctl restart "php${PHP_VERSION}-fpm"
fi

step "Installation des dépendances et compilation des assets"
composer install --optimize-autoloader --no-dev --no-interaction
npm install
npm run build

set_env "APP_URL" "https://${DOMAIN}"
set_env "APP_ENV" "production"
set_env "APP_DEBUG" "false"
db_write_env

if ! grep -q "^APP_KEY=base64" .env; then
    php artisan key:generate --force
fi

step "Migrations et mise en cache de la configuration"
php artisan storage:link || true
laravel_migrate_and_cache

step "Contenu initial du CMS"
# Uniquement si la base est vierge : les seeders réécrivent des lignes par slug/position,
# ce qui écraserait silencieusement tout contenu déjà modifié depuis l'admin si ce script
# était ré-exécuté sur un serveur déjà provisionné (ex. pour corriger une étape en échec).
if [ "$(php artisan tinker --execute='echo \App\Models\Page::query()->count();')" = "0" ]; then
    php artisan db:seed --force
else
    echo "Contenu déjà présent : seed ignoré (ré-exécution du script sur un serveur existant)."
fi

step "Permissions des dossiers writables"
chown -R www-data:www-data "$APP_DIR"
chmod -R 775 "$APP_DIR/storage" "$APP_DIR/bootstrap/cache"
if [ "$DB_ENGINE" = "sqlite" ]; then
    chmod 664 "$APP_DIR/database/database.sqlite"
    chown www-data:www-data "$APP_DIR/database/database.sqlite"
fi

step "Configuration du site Nginx"
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

step "Certificat HTTPS (Let's Encrypt)"
apt-get install -y certbot python3-certbot-nginx
echo "Le DNS de ${DOMAIN} doit déjà pointer vers l'IP de ce serveur pour que cette étape réussisse."
certbot --nginx -d "${DOMAIN}" -d "www.${DOMAIN}" --non-interactive --agree-tos -m "${LETSENCRYPT_EMAIL}" --redirect || \
    echo "AVERTISSEMENT : la génération du certificat HTTPS a échoué (DNS pas encore propagé ?). Relancez plus tard : certbot --nginx -d ${DOMAIN} -d www.${DOMAIN}"

if db_should_show_credentials; then
    db_write_credentials_file
fi

echo ""
echo "=================================================================="
echo " Terminé. Le site devrait être accessible sur https://${DOMAIN}"
echo " Base de données : ${DB_ENGINE}"
if db_should_show_credentials; then
    echo " Identifiants de connexion enregistrés dans : ${CREDS_FILE}"
    echo " (à noter en lieu sûr, puis à supprimer du serveur : rm ${CREDS_FILE})"
fi
echo " Pour les mises à jour futures, utilisez : deploy/deploy.sh"
echo "=================================================================="
