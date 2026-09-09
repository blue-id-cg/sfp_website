# Manuel de Procédure de Sauvegarde
## Site Web SFP — Procédures de Sauvegarde et de Restauration
### Société de Forages Pétroliers

---

**Référence :** SFP-BAK-PROC-2025-001  
**Version :** 1.0  
**Date :** Septembre 2025  
**Public cible :** Administrateurs système et responsables informatiques  
**Classification :** Confidentiel — Usage interne  

---

## Table des matières

1. [Vue d'ensemble de la stratégie de sauvegarde](#1-vue-densemble-de-la-stratégie-de-sauvegarde)
2. [Périmètre des sauvegardes](#2-périmètre-des-sauvegardes)
3. [Architecture de stockage](#3-architecture-de-stockage)
4. [Procédure automatique (cron quotidien)](#4-procédure-automatique-cron-quotidien)
5. [Procédure manuelle](#5-procédure-manuelle)
6. [Politique de rétention](#6-politique-de-rétention)
7. [Vérification des sauvegardes](#7-vérification-des-sauvegardes)
8. [Procédure de restauration](#8-procédure-de-restauration)
9. [Notifications et alertes](#9-notifications-et-alertes)
10. [Configuration initiale](#10-configuration-initiale)
11. [Dépannage](#11-dépannage)
12. [Journal des sauvegardes](#12-journal-des-sauvegardes)

---

## 1. Vue d'ensemble de la stratégie de sauvegarde

### 1.1 Objectifs

| Objectif | Valeur cible |
|----------|-------------|
| RPO (Recovery Point Objective) — perte de données maximale acceptable | 24 heures |
| RTO (Recovery Time Objective) — temps de restauration maximal acceptable | 4 heures |
| Durée minimale de conservation | 7 jours |
| Durée maximale de conservation | 2 ans (sauvegardes annuelles) |

### 1.2 Principe général

Le système de sauvegarde est **entièrement automatisé** via le planificateur de tâches Laravel (cron). Il s'appuie sur le package **Spatie Laravel Backup** pour créer des archives ZIP compressées et chiffrées, stockées simultanément sur :

- le **disque local** du serveur (sauvegardes rapides, accès immédiat)
- un **bucket AWS S3** (sauvegardes hors-site, protection contre la perte du serveur)

La configuration locale (sans S3) est valide mais ne protège pas contre une panne ou perte complète du serveur.

---

## 2. Périmètre des sauvegardes

### 2.1 Base de données

La sauvegarde inclut **l'intégralité de la base de données** de l'application :

| Table | Contenu | Criticité |
|-------|---------|-----------|
| `users` | Comptes administrateurs | Haute |
| `actualites` | Articles de presse | Haute |
| `offres` | Offres d'emploi | Haute |
| `gallery_images` | Métadonnées des photos | Haute |
| `contact_messages` | Messages des visiteurs + chemins des CV | Haute |
| `media` | Index des fichiers téléversés | Haute |
| `pages` | Contenus des pages principales | Haute |
| `content_blocks` | Blocs texte+icône | Haute |
| `realisations` | Projets réalisés | Haute |
| `milestones` | Jalons historiques | Haute |
| `site_settings` | Paramètres du site | Haute |
| `roles`, `permissions` | Configuration des droits | Haute |

### 2.2 Fichiers

La sauvegarde inclut les répertoires suivants du système de stockage :

| Répertoire | Contenu |
|-----------|---------|
| `storage/app/public/` | Images téléversées par les administrateurs |
| `storage/app/private/` | CV joints aux messages de contact |

> **Non inclus :** Le code source de l'application, le répertoire `vendor/`, les dépendances Node.js (`node_modules/`). Ces éléments sont récupérables depuis le dépôt Git.

---

## 3. Architecture de stockage

### 3.1 Disque local (stockage principal)

```
storage/app/backups/
├── SFP/                    ← Nom défini par BACKUP_NAME dans .env
│   ├── 2025-09-08-02-00-00.zip
│   ├── 2025-09-07-02-00-00.zip
│   └── ...
```

**Accès :** Directement sur le serveur via SSH ou panneau d'hébergement.

### 3.2 Bucket AWS S3 (stockage hors-site)

```
[bucket-name]/
└── SFP/
    ├── 2025-09-08-02-00-00.zip
    ├── 2025-09-07-02-00-00.zip
    └── ...
```

**Accès :** Console AWS (https://console.aws.amazon.com/s3) ou AWS CLI.

### 3.3 Format des archives

- **Format :** ZIP (compression Deflate)
- **Chiffrement :** AES-256 par mot de passe (si `BACKUP_ARCHIVE_PASSWORD` défini dans `.env`)
- **Nom du fichier :** `AAAA-MM-JJ-HH-MM-SS.zip`

---

## 4. Procédure automatique (cron quotidien)

### 4.1 Calendrier d'exécution

| Tâche | Heure | Fréquence |
|-------|-------|-----------|
| Nettoyage des anciennes sauvegardes | 01h00 | Quotidien |
| Création de la sauvegarde | 02h00 | Quotidien |

### 4.2 Prérequis : activation du cron

Pour que les sauvegardes automatiques fonctionnent, **une entrée cron doit être configurée sur le serveur** pour appeler le planificateur Laravel chaque minute.

#### Sur un VPS/serveur dédié (Linux)

Éditez la crontab de l'utilisateur web :

```bash
crontab -e
```

Ajoutez la ligne suivante :

```cron
* * * * * cd /chemin/vers/sfp_website && php artisan schedule:run >> /dev/null 2>&1
```

Remplacez `/chemin/vers/sfp_website` par le chemin absolu vers l'installation de l'application.

#### Sur un hébergement mutualisé (cPanel)

1. Accédez à **cPanel → Tâches Cron**
2. Créez une nouvelle tâche avec :
   - **Intervalle :** Toutes les minutes (`* * * * *`)
   - **Commande :** `cd /home/[user]/public_html && php artisan schedule:run`

### 4.3 Vérification de la configuration cron

Pour vérifier que le planificateur fonctionne :

```bash
php artisan schedule:list
```

La sortie doit afficher :
```
  0 1 * * *    php artisan backup:clean    Next Due: ...
  0 2 * * *    php artisan backup:run      Next Due: ...
```

---

## 5. Procédure manuelle

### 5.1 Déclencher une sauvegarde immédiate

Pour créer une sauvegarde hors du cycle automatique (avant une mise à jour, une migration, etc.) :

```bash
# Connexion SSH au serveur
ssh user@[adresse-ip-serveur]

# Aller dans le répertoire de l'application
cd /chemin/vers/sfp_website

# Lancer la sauvegarde manuellement
php artisan backup:run
```

**Sortie attendue :**
```
Starting backup...
Dumping database...
Creating zip archive...
Copying zip to disk named local_backups...
Copying zip to disk named s3...        ← uniquement si S3 est configuré
Backup completed!
```

### 5.2 Sauvegarde de la base de données uniquement

```bash
php artisan backup:run --only-db
```

### 5.3 Sauvegarde des fichiers uniquement

```bash
php artisan backup:run --only-files
```

### 5.4 Nettoyage manuel des anciennes sauvegardes

Pour appliquer manuellement la politique de rétention et supprimer les sauvegardes obsolètes :

```bash
php artisan backup:clean
```

### 5.5 Sauvegarde SQLite manuelle (copie directe)

Si la base de données est SQLite, une copie manuelle du fichier est également possible :

```bash
cp database/database.sqlite database/database.sqlite.backup-$(date +%Y%m%d)
```

---

## 6. Politique de rétention

Le système conserve automatiquement les sauvegardes selon la politique suivante :

| Période | Fréquence de conservation | Durée |
|---------|--------------------------|-------|
| Récent | Toutes les sauvegardes | 7 jours |
| Quotidien | 1 par jour | 30 jours |
| Hebdomadaire | 1 par semaine | 8 semaines |
| Mensuel | 1 par mois | 6 mois |
| Annuel | 1 par an | 2 ans |

> **Exemple concret :** Le 1er octobre 2025, le système conserve : les 7 dernières sauvegardes quotidiennes, 1 sauvegarde par jour des 30 derniers jours, 1 par semaine des 8 dernières semaines, 1 par mois des 6 derniers mois et 1 par an des 2 dernières années. Les autres sont supprimées automatiquement.

---

## 7. Vérification des sauvegardes

### 7.1 Vérification quotidienne recommandée

Il est recommandé de vérifier **au moins une fois par semaine** que les sauvegardes s'exécutent correctement.

#### Méthode 1 : Vérification via la commande Artisan

```bash
php artisan backup:monitor
```

Cette commande vérifie que :
- Des sauvegardes récentes existent
- La taille des archives est cohérente
- Les disques de destination sont accessibles

**Sortie attendue (tout OK) :**
```
Backup SFP on disk local_backups is healthy!
Backup SFP on disk s3 is healthy!
```

#### Méthode 2 : Vérification dans les logs

```bash
tail -n 100 storage/logs/laravel.log | grep -i "backup"
```

Recherchez des lignes contenant `backup completed` (succès) ou `backup failed` (échec).

#### Méthode 3 : Vérification directe des fichiers

```bash
ls -lh storage/app/backups/SFP/ | tail -5
```

Vérifiez que le fichier le plus récent date bien d'aujourd'hui (ou d'hier si vérification avant 02h00).

### 7.2 Test d'intégrité d'une archive

Pour vérifier qu'une archive ZIP n'est pas corrompue :

```bash
# Tester l'archive sans extraire
unzip -t storage/app/backups/SFP/2025-09-08-02-00-00.zip
```

Pour une archive chiffrée (si `BACKUP_ARCHIVE_PASSWORD` est défini) :

```bash
unzip -P [mot-de-passe] -t storage/app/backups/SFP/2025-09-08-02-00-00.zip
```

---

## 8. Procédure de restauration

> **Avertissement :** La restauration écrase les données existantes. Effectuez toujours une sauvegarde de l'état actuel avant de restaurer une version antérieure.

### 8.1 Restauration complète depuis une archive locale

#### Étape 1 — Identifier l'archive à restaurer

```bash
ls -lh storage/app/backups/SFP/
```

Notez le nom du fichier de la sauvegarde à restaurer (ex. : `2025-09-05-02-00-00.zip`).

#### Étape 2 — Activer le mode maintenance

```bash
php artisan down
```

#### Étape 3 — Créer une sauvegarde de précaution

```bash
php artisan backup:run
```

#### Étape 4 — Extraire l'archive

```bash
# Créer un répertoire temporaire
mkdir /tmp/restore-sfp

# Extraire l'archive (sans mot de passe)
unzip storage/app/backups/SFP/2025-09-05-02-00-00.zip -d /tmp/restore-sfp

# Avec mot de passe
unzip -P [mot-de-passe] storage/app/backups/SFP/2025-09-05-02-00-00.zip -d /tmp/restore-sfp

# Vérifier le contenu extrait
ls /tmp/restore-sfp/
```

L'archive contient généralement :
- `db-dumps/` — Dump de la base de données
- `storage/` — Fichiers uploadés

#### Étape 5 — Restaurer la base de données

**Pour SQLite :**
```bash
cp /tmp/restore-sfp/db-dumps/sqlite-database.sql.gz /tmp/
gunzip /tmp/sqlite-database.sql.gz
# Restaurer le dump SQL dans la base
sqlite3 database/database.sqlite < /tmp/sqlite-database.sql
```

**Pour MySQL / MariaDB :**
```bash
gunzip -c /tmp/restore-sfp/db-dumps/[nom-base].sql.gz | mysql -u [user] -p [nom-base]
```

**Pour PostgreSQL :**
```bash
gunzip -c /tmp/restore-sfp/db-dumps/[nom-base].sql.gz | psql -U [user] [nom-base]
```

#### Étape 6 — Restaurer les fichiers

```bash
# Supprimer les fichiers actuels
rm -rf storage/app/public/
rm -rf storage/app/private/

# Restaurer depuis l'archive
cp -r /tmp/restore-sfp/storage/app/public/ storage/app/
cp -r /tmp/restore-sfp/storage/app/private/ storage/app/
```

#### Étape 7 — Corriger les permissions

```bash
chmod -R 775 storage/
chown -R www-data:www-data storage/
```

#### Étape 8 — Vider les caches

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

#### Étape 9 — Désactiver le mode maintenance

```bash
php artisan up
```

#### Étape 10 — Vérifier le site

Ouvrez le site dans un navigateur et vérifiez que :
- La page d'accueil s'affiche correctement
- Les images sont visibles
- La connexion au panneau d'administration fonctionne

### 8.2 Restauration depuis AWS S3

Si le serveur est inaccessible ou si les sauvegardes locales sont perdues :

```bash
# Installer AWS CLI si nécessaire
# aws configure (renseigner les clés AWS)

# Lister les sauvegardes disponibles
aws s3 ls s3://[bucket-name]/SFP/

# Télécharger une sauvegarde
aws s3 cp s3://[bucket-name]/SFP/2025-09-05-02-00-00.zip /tmp/

# Reprendre à l'étape 4 de la restauration complète
```

---

## 9. Notifications et alertes

### 9.1 Notifications automatiques

Le système envoie automatiquement des e-mails à l'adresse configurée dans `MAIL_ADMIN_ADDRESS` dans les cas suivants :

| Événement | Notification |
|-----------|-------------|
| Échec d'une sauvegarde | E-mail immédiat avec détail de l'erreur |
| Sauvegarde trop ancienne (>1 jour) | E-mail d'alerte |
| Archive trop petite (anomalie) | E-mail d'alerte |

### 9.2 Réagir à une alerte

En cas de réception d'une alerte par e-mail :

1. **Connectez-vous au serveur en SSH**
2. **Vérifiez les logs :** `tail -n 200 storage/logs/laravel.log`
3. **Testez la connexion au disque de sauvegarde :** `php artisan backup:monitor`
4. **Relancez manuellement :** `php artisan backup:run`
5. **Si le problème persiste :** consultez la section [Dépannage](#11-dépannage)

---

## 10. Configuration initiale

### 10.1 Variables d'environnement requises

Dans le fichier `.env` du serveur de production :

```env
# Nom de l'application dans les archives
BACKUP_NAME=SFP

# Mot de passe de chiffrement des archives (recommandé)
BACKUP_ARCHIVE_PASSWORD=votre-mot-de-passe-securise

# E-mail pour les notifications d'alertes
MAIL_ADMIN_ADDRESS=admin@sfp.cg

# Configuration AWS S3 (optionnel mais recommandé)
AWS_ACCESS_KEY_ID=AKIAIOSFODNN7EXAMPLE
AWS_SECRET_ACCESS_KEY=wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY
AWS_DEFAULT_REGION=eu-west-1
AWS_BUCKET=sfp-backups
```

### 10.2 Vérifier la configuration

```bash
# Tester que tout est correctement configuré
php artisan backup:run --only-to-disk=local_backups

# Vérifier que S3 est accessible (si configuré)
php artisan backup:run --only-to-disk=s3
```

---

## 11. Dépannage

### 11.1 La sauvegarde échoue avec "No space left on device"

**Symptôme :** Le log indique une erreur d'espace disque.

**Solution :**
```bash
# Vérifier l'espace disponible
df -h

# Nettoyer les vieilles sauvegardes
php artisan backup:clean

# Vérifier l'espace après nettoyage
df -h
```

Si l'espace est toujours insuffisant, contactez l'hébergeur pour augmenter la capacité ou configurez S3 comme destination principale.

### 11.2 La sauvegarde échoue avec une erreur S3

**Symptôme :** Message `Could not connect to S3` ou `Access Denied`.

**Solutions :**
1. Vérifiez les clés AWS dans `.env` (`AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`)
2. Vérifiez que le bucket existe et est accessible depuis la région configurée
3. Vérifiez les permissions IAM de l'utilisateur AWS (s3:PutObject, s3:GetObject, s3:DeleteObject sur le bucket)
4. Désactivez temporairement S3 pour ne sauvegarder qu'en local :

```bash
php artisan backup:run --only-to-disk=local_backups
```

### 11.3 Les sauvegardes automatiques ne s'exécutent pas

**Symptôme :** Aucune nouvelle archive depuis plus de 24 heures.

**Vérification :**
```bash
# Tester le planificateur manuellement
php artisan schedule:run --verbose

# Vérifier que la crontab est configurée
crontab -l
```

**Solution :** Vérifiez que l'entrée cron `* * * * * cd /chemin && php artisan schedule:run` est présente et que le chemin est correct.

### 11.4 Archive corrompue ou impossible à ouvrir

**Symptôme :** `unzip` renvoie une erreur lors de la vérification.

**Solution :**
1. Essayez la sauvegarde du jour précédent
2. Vérifiez si le mot de passe de chiffrement est correct
3. Relancez une nouvelle sauvegarde : `php artisan backup:run`

---

## 12. Journal des sauvegardes

Conservez ce journal mensuel pour tracer les opérations de sauvegarde manuelles et les incidents.

| Date | Type | Disque | Résultat | Responsable | Commentaire |
|------|------|--------|----------|-------------|-------------|
| | Auto | Local + S3 | | Système | |
| | Manuel | | | | |
| | Restauration | | | | |

---

**Checklist mensuelle de vérification :**

- [ ] Exécuter `php artisan backup:monitor` et vérifier que toutes les destinations sont saines
- [ ] Vérifier la taille des archives (doit rester cohérente d'un jour à l'autre)
- [ ] Tester le téléchargement d'une archive S3 (si configuré)
- [ ] Vérifier que les e-mails de notification sont bien reçus (simuler un test)
- [ ] Vérifier l'espace disque disponible sur le serveur
- [ ] Mettre à jour ce journal

---

*Manuel de Procédure de Sauvegarde — SFP Website v1.0 — Septembre 2025*  
*À réviser en cas de changement d'infrastructure ou de configuration*
