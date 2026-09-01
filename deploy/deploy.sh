#!/usr/bin/env bash
#
# Mise à jour de l'application sur un serveur déjà provisionné
# (après avoir exécuté deploy/provision.sh une première fois).
#
# Usage, depuis le dossier du projet sur le serveur :
#   bash deploy/deploy.sh

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
source "${SCRIPT_DIR}/lib.sh"
source "${SCRIPT_DIR}/laravel.sh"

TOTAL_STEPS=7
STEP=0

step "Mode maintenance"
php artisan down --retry=60
# Quoi qu'il arrive ensuite (échec d'une étape, Ctrl+C...), on ne laisse jamais le site bloqué
# en maintenance sans que personne ne s'en aperçoive.
trap 'php artisan up >/dev/null 2>&1 || true' EXIT

step "Récupération des derniers changements"
if [ -d .git ]; then
    git pull
else
    echo "Pas de dépôt Git ici : envoyez d'abord les nouveaux fichiers (FTP/SCP) avant de relancer ce script."
fi

step "Installation des dépendances"
composer install --optimize-autoloader --no-dev --no-interaction
npm install
npm run build

step "Migrations et mise en cache de la configuration"
laravel_migrate_and_cache

step "Synchronisation des rôles et permissions"
# Sans danger à ré-exécuter à chaque déploiement (findOrCreate/syncPermissions) : contrairement
# aux seeders de contenu (pages, blocs, réalisations...), celui-ci ne touche à aucune donnée
# éditée depuis l'admin. Ça garde les permissions à jour si de nouvelles sont ajoutées au code.
php artisan db:seed --class=RolesAndPermissionsSeeder --force

step "Permissions"
if ! chmod -R 775 storage bootstrap/cache 2>/dev/null; then
    echo "Avertissement : certains fichiers dans storage/ appartiennent à un autre utilisateur"
    echo "(probablement www-data, l'utilisateur du serveur web) et n'ont pas pu être modifiés"
    echo "par $(whoami). Ce n'est pas bloquant : le site reste à jour. Voir DEPLOIEMENT.md,"
    echo "section « Permissions », pour corriger ça une bonne fois pour toutes."
fi

step "Fin de la maintenance"
php artisan up

echo ""
echo "Terminé : le site est à jour."
