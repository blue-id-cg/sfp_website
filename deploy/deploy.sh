#!/usr/bin/env bash
#
# Mise à jour de l'application sur un serveur déjà provisionné
# (après avoir exécuté deploy/provision.sh une première fois).
#
# Usage, depuis le dossier du projet sur le serveur :
#   bash deploy/deploy.sh

set -euo pipefail

echo "==> Récupération des derniers changements"
if [ -d .git ]; then
    git pull
else
    echo "Pas de dépôt Git ici : envoyez d'abord les nouveaux fichiers (FTP/SCP) avant de relancer ce script."
fi

echo "==> Installation des dépendances"
composer install --optimize-autoloader --no-dev --no-interaction
npm install
npm run build

echo "==> Rafraîchissement des caches Laravel"
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Permissions"
chmod -R 775 storage bootstrap/cache

echo "Terminé : le site est à jour."
