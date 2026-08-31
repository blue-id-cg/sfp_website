#!/usr/bin/env bash
#
# Fonctions utilitaires génériques partagées par provision.sh et deploy.sh :
# affichage des étapes, lecture et écriture sûres du fichier .env.
#
# Ce fichier n'est pas exécutable seul : il est chargé via `source`.

STEP=${STEP:-0}
TOTAL_STEPS=${TOTAL_STEPS:-0}

# step "Libellé" — affiche un séparateur d'étape, numéroté si TOTAL_STEPS > 0.
step() {
    STEP=$((STEP + 1))
    echo ""
    if [ "$TOTAL_STEPS" -gt 0 ]; then
        echo "==> [${STEP}/${TOTAL_STEPS}] $1"
    else
        echo "==> $1"
    fi
}

# Échappe une valeur pour une utilisation sûre dans un remplacement sed "s#...#...#".
sed_escape() {
    printf '%s' "$1" | sed -e 's/[#&\\]/\\&/g'
}

# get_env KEY — lit la valeur actuelle d'une clé dans le .env du dossier courant
# (chaîne vide si le fichier ou la clé n'existe pas). Le `|| true` final évite
# qu'une clé absente (cas normal au premier lancement) ne fasse échouer tout
# le script appelant sous `set -o pipefail`.
get_env() {
    local key="$1"
    [ -f .env ] || return 0
    grep "^${key}=" .env | head -n1 | cut -d= -f2- || true
}

# set_env KEY VALUE — met à jour (ou ajoute) une clé dans le fichier .env.
# Remplace la ligne active si elle existe, sinon décommente/remplace un
# exemple placeholder ("# KEY=..."), sinon ajoute une nouvelle ligne.
set_env() {
    local key="$1" value="$2" escaped
    escaped="$(sed_escape "$value")"
    if grep -q "^${key}=" .env; then
        sed -i "s#^${key}=.*#${key}=${escaped}#" .env
    elif grep -qE "^#[[:space:]]*${key}=" .env; then
        sed -i -E "/^#[[:space:]]*${key}=/d" .env
        echo "${key}=${value}" >> .env
    else
        echo "${key}=${value}" >> .env
    fi
}

# Génère un mot de passe aléatoire adapté à une utilisation directe dans .env
# et dans une chaîne SQL entre quotes simples (hexadécimal : aucun caractère
# à échapper).
generate_password() {
    openssl rand -hex 16
}
