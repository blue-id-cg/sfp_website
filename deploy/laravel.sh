#!/usr/bin/env bash
#
# Commandes Laravel communes à l'installation initiale (provision.sh) et aux
# mises à jour (deploy.sh), pour éviter que les deux scripts ne divergent.
#
# Ce fichier n'est pas exécutable seul : il est chargé via `source`.

laravel_migrate_and_cache() {
    php artisan app:configure-production-database
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
}
