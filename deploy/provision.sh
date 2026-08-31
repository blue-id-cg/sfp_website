#!/usr/bin/env bash
#
# Provisionnement d'un serveur Ubuntu/Debian VIERGE pour héberger le site SFP.
# À exécuter UNE SEULE FOIS, en tant que root, sur un serveur tout neuf.
#
# Ce script installe et configure : Nginx, PHP-FPM, Composer, Node.js, la base
# de données (SQLite, MySQL, MariaDB ou PostgreSQL), le certificat HTTPS
# (Let's Encrypt), puis déploie l'application.
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

DB_ENGINE="${DB_ENGINE:-sqlite}"
DB_HOST="${DB_HOST:-}"
DB_PORT="${DB_PORT:-}"
DB_DATABASE="${DB_DATABASE:-}"
DB_USERNAME="${DB_USERNAME:-}"
DB_PASSWORD="${DB_PASSWORD:-}"
LETSENCRYPT_EMAIL="${LETSENCRYPT_EMAIL:-contact@snpc-sfp.net}"

TOTAL_STEPS=11
STEP=0
step() {
    STEP=$((STEP + 1))
    echo ""
    echo "==> [${STEP}/${TOTAL_STEPS}] $1"
}

if [ -z "$DOMAIN" ]; then
    echo "Usage : sudo bash provision.sh votre-domaine.com [url-du-depot-git]"
    exit 1
fi

if [ "$(id -u)" -ne 0 ]; then
    echo "Ce script doit être exécuté en root (utilisez : sudo bash provision.sh ...)"
    exit 1
fi

case "$DB_ENGINE" in
    sqlite|mysql|mariadb|pgsql) ;;
    *)
        echo "DB_ENGINE invalide : '${DB_ENGINE}' (valeurs possibles : sqlite, mysql, mariadb, pgsql)"
        exit 1
        ;;
esac

# Base de données externe (déjà créée par un hébergeur) si les 4 identifiants
# sont fournis ; sinon le script installe et crée la base localement.
DB_EXTERNAL=false
if [ -n "$DB_HOST" ] && [ -n "$DB_DATABASE" ] && [ -n "$DB_USERNAME" ] && [ -n "$DB_PASSWORD" ]; then
    DB_EXTERNAL=true
fi

# Échappe une valeur pour une utilisation sûre dans un remplacement sed "s#...#...#".
sed_escape() {
    printf '%s' "$1" | sed -e 's/[#&\\]/\\&/g'
}

# set_env KEY VALUE — met à jour (ou ajoute) une clé dans le fichier .env.
set_env() {
    local key="$1" value="$2" escaped
    escaped="$(sed_escape "$value")"
    if grep -q "^${key}=" .env; then
        sed -i "s#^${key}=.*#${key}=${escaped}#" .env
    elif grep -q "^# ${key}=" .env; then
        sed -i "s#^# ${key}=.*#${key}=${escaped}#" .env
    else
        echo "${key}=${value}" >> .env
    fi
}

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

step "Base de données (${DB_ENGINE})"
case "$DB_ENGINE" in
    sqlite)
        mkdir -p database
        touch database/database.sqlite
        DB_DATABASE_PATH="${APP_DIR}/database/database.sqlite"
        ;;

    mysql|mariadb)
        DB_HOST="${DB_HOST:-127.0.0.1}"
        DB_PORT="${DB_PORT:-3306}"
        DB_DATABASE="${DB_DATABASE:-sfp_website}"
        DB_USERNAME="${DB_USERNAME:-sfp_website}"

        apt-get install -y "php${PHP_VERSION}-mysql"

        if [ "$DB_EXTERNAL" = false ]; then
            DB_PASSWORD="${DB_PASSWORD:-$(openssl rand -base64 24 | tr -dc 'A-Za-z0-9' | head -c 24)}"
            if [ "$DB_ENGINE" = "mysql" ]; then
                apt-get install -y mysql-server
                systemctl enable --now mysql
            else
                apt-get install -y mariadb-server
                systemctl enable --now mariadb
            fi

            mysql -u root <<SQL
CREATE DATABASE IF NOT EXISTS \`${DB_DATABASE}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USERNAME}'@'${DB_HOST}' IDENTIFIED BY '${DB_PASSWORD}';
GRANT ALL PRIVILEGES ON \`${DB_DATABASE}\`.* TO '${DB_USERNAME}'@'${DB_HOST}';
FLUSH PRIVILEGES;
SQL
        else
            echo "Base de données externe fournie (${DB_HOST}:${DB_PORT}) — aucune installation locale."
        fi
        ;;

    pgsql)
        DB_HOST="${DB_HOST:-127.0.0.1}"
        DB_PORT="${DB_PORT:-5432}"
        DB_DATABASE="${DB_DATABASE:-sfp_website}"
        DB_USERNAME="${DB_USERNAME:-sfp_website}"

        apt-get install -y "php${PHP_VERSION}-pgsql"

        if [ "$DB_EXTERNAL" = false ]; then
            DB_PASSWORD="${DB_PASSWORD:-$(openssl rand -base64 24 | tr -dc 'A-Za-z0-9' | head -c 24)}"
            apt-get install -y postgresql postgresql-contrib
            systemctl enable --now postgresql

            sudo -u postgres psql -v ON_ERROR_STOP=1 -c "DO \$\$ BEGIN IF NOT EXISTS (SELECT FROM pg_catalog.pg_roles WHERE rolname = '${DB_USERNAME}') THEN CREATE ROLE \"${DB_USERNAME}\" LOGIN PASSWORD '${DB_PASSWORD}'; END IF; END \$\$;"
            if ! sudo -u postgres psql -tAc "SELECT 1 FROM pg_database WHERE datname = '${DB_DATABASE}'" | grep -q 1; then
                sudo -u postgres psql -c "CREATE DATABASE \"${DB_DATABASE}\" OWNER \"${DB_USERNAME}\";"
            fi
            # PostgreSQL (paquet Ubuntu/Debian) autorise déjà les connexions
            # locales en mot de passe (md5/scram) sur 127.0.0.1 par défaut.
        else
            echo "Base de données externe fournie (${DB_HOST}:${DB_PORT}) — aucune installation locale."
        fi
        ;;
esac

if [ "$DB_ENGINE" != "sqlite" ]; then
    systemctl restart "php${PHP_VERSION}-fpm"
fi

step "Installation des dépendances et compilation des assets"
composer install --optimize-autoloader --no-dev --no-interaction
npm install
npm run build

if [ ! -f .env ]; then
    cp .env.example .env
fi
sed -i "s#^APP_URL=.*#APP_URL=https://${DOMAIN}#" .env
sed -i "s/^APP_ENV=.*/APP_ENV=production/" .env
sed -i "s/^APP_DEBUG=.*/APP_DEBUG=false/" .env

set_env "DB_CONNECTION" "$DB_ENGINE"
if [ "$DB_ENGINE" = "sqlite" ]; then
    set_env "DB_DATABASE" "$DB_DATABASE_PATH"
else
    set_env "DB_HOST" "$DB_HOST"
    set_env "DB_PORT" "$DB_PORT"
    set_env "DB_DATABASE" "$DB_DATABASE"
    set_env "DB_USERNAME" "$DB_USERNAME"
    set_env "DB_PASSWORD" "$DB_PASSWORD"
fi

if ! grep -q "^APP_KEY=base64" .env; then
    php artisan key:generate --force
fi

step "Migrations et mise en cache de la configuration"
php artisan migrate --force
php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

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

if [ "$DB_ENGINE" != "sqlite" ] && [ "$DB_EXTERNAL" = false ]; then
    CREDS_FILE="/root/sfp_website_db_credentials.txt"
    cat > "$CREDS_FILE" <<CREDS
Base de données créée pour le site SFP (${DOMAIN})
Moteur       : ${DB_ENGINE}
Base         : ${DB_DATABASE}
Utilisateur  : ${DB_USERNAME}
Mot de passe : ${DB_PASSWORD}
Hôte:Port    : ${DB_HOST}:${DB_PORT}
CREDS
    chmod 600 "$CREDS_FILE"
fi

echo ""
echo "=================================================================="
echo " Terminé. Le site devrait être accessible sur https://${DOMAIN}"
echo " Base de données : ${DB_ENGINE}"
if [ "$DB_ENGINE" != "sqlite" ] && [ "$DB_EXTERNAL" = false ]; then
    echo " Identifiants de connexion enregistrés dans : /root/sfp_website_db_credentials.txt"
    echo " (à noter en lieu sûr, puis à supprimer du serveur : rm /root/sfp_website_db_credentials.txt)"
fi
echo " Pour les mises à jour futures, utilisez : deploy/deploy.sh"
echo "=================================================================="
