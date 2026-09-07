#!/usr/bin/env bash
#
# Commandes Laravel communes à l'installation initiale (provision.sh) et aux
# mises à jour (deploy.sh), pour éviter que les deux scripts ne divergent.
#
# Ce fichier n'est pas exécutable seul : il est chargé via `source`.

laravel_migrate_and_cache() {
    db_connection="${DB_CONNECTION:-$(sed -n 's/^DB_CONNECTION=//p' .env 2>/dev/null | tail -n 1 | tr -d "'\"")}";

    if [ "${db_connection:-sqlite}" = "sqlite" ]; then
        mkdir -p database
        touch database/database.sqlite
        chmod 775 database
        chmod 664 database/database.sqlite

        if command -v sudo >/dev/null 2>&1 && sudo -n true 2>/dev/null; then
            sudo -n chown "$(id -un)":www-data database database/database.sqlite
        fi
    fi

    php artisan app:configure-production-database
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
}
