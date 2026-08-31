#!/usr/bin/env bash
#
# Provisionnement de la base de données : une fonction par responsabilité
# (validation, résolution des valeurs, installation par moteur), pour que
# provision.sh reste un simple enchaînement d'étapes.
#
# Ce fichier n'est pas exécutable seul : il est chargé via `source`, après
# lib.sh (utilise step/get_env/set_env/generate_password) et attend que
# PHP_VERSION, APP_DIR et DOMAIN soient déjà définis par le script appelant.

# validate_db_engine VALEUR — vérifie que le moteur demandé est supporté.
validate_db_engine() {
    case "$1" in
        sqlite|mysql|mariadb|pgsql) ;;
        *)
            echo "DB_ENGINE invalide : '$1' (valeurs possibles : sqlite, mysql, mariadb, pgsql)"
            exit 1
            ;;
    esac
}

# resolve_db_external — une base externe (déjà créée par un hébergeur) exige
# les 4 identifiants (DB_HOST/DB_DATABASE/DB_USERNAME/DB_PASSWORD) ; une base
# locale n'en exige aucun. Un mélange des deux est ambigu (ex. un DB_HOST
# externe combiné à une installation locale) et est donc refusé explicitement
# plutôt que d'être deviné.
resolve_db_external() {
    if [ -z "$DB_HOST" ] && [ -z "$DB_DATABASE" ] && [ -z "$DB_USERNAME" ] && [ -z "$DB_PASSWORD" ]; then
        DB_EXTERNAL=false
        return
    fi
    if [ -n "$DB_HOST" ] && [ -n "$DB_DATABASE" ] && [ -n "$DB_USERNAME" ] && [ -n "$DB_PASSWORD" ]; then
        DB_EXTERNAL=true
        return
    fi
    echo "ERREUR : pour une base de données externe, fournissez les 4 variables DB_HOST, DB_DATABASE,"
    echo "DB_USERNAME et DB_PASSWORD. Pour une base locale, ne fournissez aucune de ces 4 variables"
    echo "(des valeurs par défaut seront utilisées)."
    exit 1
}

# validate_db_identifier VALEUR LABEL — un nom de base/utilisateur local doit
# rester un identifiant simple : il est injecté tel quel dans du SQL.
validate_db_identifier() {
    local value="$1" label="$2"
    if ! [[ "$value" =~ ^[A-Za-z_][A-Za-z0-9_]*$ ]]; then
        echo "ERREUR : ${label} invalide : '${value}' (lettres, chiffres et underscore uniquement, ne peut pas commencer par un chiffre)."
        exit 1
    fi
}

# Échappe un mot de passe pour une chaîne SQL MySQL/MariaDB entre quotes simples.
mysql_escape() {
    printf '%s' "$1" | sed -e 's/\\/\\\\/g' -e "s/'/\\\\'/g"
}

# Échappe un mot de passe pour une chaîne SQL PostgreSQL entre quotes simples.
pg_escape() {
    printf '%s' "$1" | sed -e "s/'/''/g"
}

# db_apply_defaults PORT_PAR_DEFAUT — complète DB_HOST/DB_PORT/DB_DATABASE/
# DB_USERNAME : valeur déjà fournie > valeur déjà présente dans .env (cas
# d'une ré-exécution) > valeur par défaut. Sans effet quand DB_EXTERNAL=true,
# les 4 identifiants étant alors déjà tous fournis.
db_apply_defaults() {
    local default_port="$1"
    DB_HOST="${DB_HOST:-$(get_env DB_HOST)}"
    DB_HOST="${DB_HOST:-127.0.0.1}"
    DB_PORT="${DB_PORT:-$(get_env DB_PORT)}"
    DB_PORT="${DB_PORT:-$default_port}"
    DB_DATABASE="${DB_DATABASE:-$(get_env DB_DATABASE)}"
    DB_DATABASE="${DB_DATABASE:-sfp_website}"
    DB_USERNAME="${DB_USERNAME:-$(get_env DB_USERNAME)}"
    DB_USERNAME="${DB_USERNAME:-sfp_website}"
}

# db_resolve_password — réutilise le mot de passe déjà écrit dans .env lors
# d'une précédente exécution (pour rester en phase avec le compte déjà créé
# côté serveur SQL), sinon en génère un nouveau.
db_resolve_password() {
    DB_PASSWORD="${DB_PASSWORD:-$(get_env DB_PASSWORD)}"
    DB_PASSWORD="${DB_PASSWORD:-$(generate_password)}"
}

# provision_mysql_like PAQUET SERVICE — MySQL et MariaDB ne diffèrent que par
# le nom du paquet et du service systemd.
provision_mysql_like() {
    local pkg="$1" svc="$2"

    if [ "$DB_EXTERNAL" = true ]; then
        apt-get install -y "php${PHP_VERSION}-mysql"
        echo "Base de données externe fournie (${DB_HOST}:${DB_PORT}) — aucune installation locale."
        return
    fi

    validate_db_identifier "$DB_DATABASE" "DB_DATABASE"
    validate_db_identifier "$DB_USERNAME" "DB_USERNAME"
    db_resolve_password

    apt-get install -y "php${PHP_VERSION}-mysql" "$pkg"
    systemctl enable --now "$svc"

    local escaped_password
    escaped_password="$(mysql_escape "$DB_PASSWORD")"
    mysql -u root <<SQL
CREATE DATABASE IF NOT EXISTS \`${DB_DATABASE}\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS '${DB_USERNAME}'@'${DB_HOST}' IDENTIFIED BY '${escaped_password}';
ALTER USER '${DB_USERNAME}'@'${DB_HOST}' IDENTIFIED BY '${escaped_password}';
GRANT ALL PRIVILEGES ON \`${DB_DATABASE}\`.* TO '${DB_USERNAME}'@'${DB_HOST}';
SQL
}

provision_pgsql() {
    if [ "$DB_EXTERNAL" = true ]; then
        apt-get install -y "php${PHP_VERSION}-pgsql"
        echo "Base de données externe fournie (${DB_HOST}:${DB_PORT}) — aucune installation locale."
        return
    fi

    validate_db_identifier "$DB_DATABASE" "DB_DATABASE"
    validate_db_identifier "$DB_USERNAME" "DB_USERNAME"
    db_resolve_password

    apt-get install -y "php${PHP_VERSION}-pgsql" postgresql postgresql-contrib
    systemctl enable --now postgresql

    local escaped_password
    escaped_password="$(pg_escape "$DB_PASSWORD")"
    sudo -u postgres psql -v ON_ERROR_STOP=1 -c "DO \$\$ BEGIN IF NOT EXISTS (SELECT FROM pg_catalog.pg_roles WHERE rolname = '${DB_USERNAME}') THEN CREATE ROLE \"${DB_USERNAME}\" LOGIN PASSWORD '${escaped_password}'; ELSE ALTER ROLE \"${DB_USERNAME}\" LOGIN PASSWORD '${escaped_password}'; END IF; END \$\$;"
    if ! sudo -u postgres psql -tAc "SELECT 1 FROM pg_database WHERE datname = '${DB_DATABASE}'" | grep -q 1; then
        sudo -u postgres psql -c "CREATE DATABASE \"${DB_DATABASE}\" OWNER \"${DB_USERNAME}\";"
    fi
    # PostgreSQL (paquet Ubuntu/Debian) autorise déjà les connexions
    # locales en mot de passe (md5/scram) sur 127.0.0.1 par défaut.
}

provision_sqlite() {
    mkdir -p database
    touch database/database.sqlite
    DB_DATABASE_PATH="${APP_DIR}/database/database.sqlite"
}

# db_provision — point d'entrée unique, dispatché selon DB_ENGINE.
db_provision() {
    case "$DB_ENGINE" in
        sqlite)
            provision_sqlite
            ;;
        mysql)
            db_apply_defaults 3306
            provision_mysql_like mysql-server mysql
            ;;
        mariadb)
            db_apply_defaults 3306
            provision_mysql_like mariadb-server mariadb
            ;;
        pgsql)
            db_apply_defaults 5432
            provision_pgsql
            ;;
    esac
}

db_write_env() {
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
}

# db_should_show_credentials — vrai uniquement quand ce script vient de créer
# lui-même un compte de base de données (unique source de vérité, utilisée à
# la fois pour écrire le fichier d'identifiants et pour l'annoncer).
db_should_show_credentials() {
    [ "$DB_ENGINE" != "sqlite" ] && [ "$DB_EXTERNAL" = false ]
}

# db_write_credentials_file — définit CREDS_FILE (utilisé ensuite par
# l'appelant pour l'afficher dans le résumé final).
db_write_credentials_file() {
    CREDS_FILE="/root/sfp_website_db_credentials.txt"
    (
        umask 077
        cat > "$CREDS_FILE" <<CREDS
Base de données créée pour le site SFP (${DOMAIN})
Moteur       : ${DB_ENGINE}
Base         : ${DB_DATABASE}
Utilisateur  : ${DB_USERNAME}
Mot de passe : ${DB_PASSWORD}
Hôte:Port    : ${DB_HOST}:${DB_PORT}
CREDS
    )
}
