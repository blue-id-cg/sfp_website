# Documentation Technique
## Site Web SFP — Architecture, Installation et Maintenance
### Société de Forages Pétroliers

---

**Référence :** SFP-DOC-TECH-2025-001  
**Version :** 1.0  
**Date :** Septembre 2025  
**Public cible :** Développeurs et administrateurs système  

---

## Table des matières

1. [Vue d'ensemble](#1-vue-densemble)
2. [Stack technique](#2-stack-technique)
3. [Architecture de l'application](#3-architecture-de-lapplication)
4. [Schéma de base de données](#4-schéma-de-base-de-données)
5. [Routes et API](#5-routes-et-api)
6. [Modèles et logique métier](#6-modèles-et-logique-métier)
7. [Authentification et autorisation](#7-authentification-et-autorisation)
8. [Gestion des médias et fichiers](#8-gestion-des-médias-et-fichiers)
9. [Frontend et assets](#9-frontend-et-assets)
10. [Configuration de l'environnement](#10-configuration-de-lenvironnement)
11. [Installation et déploiement](#11-installation-et-déploiement)
12. [Sauvegardes automatiques](#12-sauvegardes-automatiques)
13. [Suite de tests](#13-suite-de-tests)
14. [Maintenance et opérations](#14-maintenance-et-opérations)
15. [Dépendances et licences](#15-dépendances-et-licences)

---

## 1. Vue d'ensemble

### 1.1 Description du projet

Le site web SFP est une application web Laravel combinant :
- Un **site institutionnel** public présentant la Société de Forages Pétroliers
- Un **CMS (Content Management System)** d'administration pour gérer le contenu sans compétences techniques

### 1.2 Caractéristiques principales

| Caractéristique | Valeur |
|-----------------|--------|
| Framework | Laravel 13.x |
| PHP | 8.5+ |
| Base de données | SQLite (production par défaut) |
| Langue de l'interface | Français |
| Serveur web cible | Nginx ou Apache |
| Déploiement | VPS Linux ou hébergement mutualisé PHP |

---

## 2. Stack technique

### 2.1 Backend

| Package | Version | Usage |
|---------|---------|-------|
| `laravel/framework` | ^13.0 | Framework applicatif complet |
| `spatie/laravel-permission` | ^6.25 | Gestion des rôles et permissions |
| `spatie/laravel-backup` | ^10.3 | Sauvegardes automatiques |
| `league/flysystem-aws-s3-v3` | ^3.35 | Adapter S3 pour stockage cloud |
| `laravel/tinker` | ^3.0 | REPL de débogage |

### 2.2 Outils de développement

| Package | Version | Usage |
|---------|---------|-------|
| `laravel/breeze` | ^2.4 | Scaffolding d'authentification |
| `laravel/pint` | ^1.27 | Formatage du code PHP |
| `pestphp/pest` | ^4.7 | Framework de tests |
| `fakerphp/faker` | ^1.23 | Génération de données de test |
| `mockery/mockery` | ^1.6 | Bibliothèque de mocking |

### 2.3 Frontend

| Package | Version | Usage |
|---------|---------|-------|
| `tailwindcss` | ^4.0 | Framework CSS utilitaire |
| `alpinejs` | ^3.17 | Réactivité JS légère |
| `quill` | ^2.0 | Éditeur de texte enrichi |
| `@yaireo/tagify` | ^4.38 | Champ de saisie de tags |
| `notyf` | ^3.10 | Notifications toast |
| `axios` | ^1.11 | Client HTTP |
| `vite` | ^8.0 | Bundler et serveur de développement |
| `laravel-vite-plugin` | ^3.0 | Intégration Vite/Laravel |

---

## 3. Architecture de l'application

### 3.1 Structure des répertoires

```
sfp_website/
├── app/
│   ├── Console/
│   │   └── Commands/                    # Commandes Artisan personnalisées
│   │       ├── ConfigureProductionDatabase.php
│   │       └── CreateAdminUser.php
│   ├── Http/
│   │   ├── Controllers/                 # Contrôleurs publics
│   │   │   ├── HomeController.php
│   │   │   ├── ActualiteController.php
│   │   │   ├── CarriereController.php
│   │   │   ├── ContactController.php
│   │   │   ├── GalleryController.php
│   │   │   ├── SeoController.php
│   │   │   └── ...
│   │   ├── Controllers/Admin/           # Contrôleurs d'administration
│   │   │   ├── DashboardController.php
│   │   │   ├── ActualiteController.php
│   │   │   ├── OffreController.php
│   │   │   ├── GalleryImageController.php
│   │   │   ├── MediaController.php
│   │   │   ├── ContentBlockController.php
│   │   │   ├── PageController.php
│   │   │   ├── RealisationController.php
│   │   │   ├── MilestoneController.php
│   │   │   ├── ContactMessageController.php
│   │   │   ├── UserController.php
│   │   │   └── SiteSettingController.php
│   │   ├── Controllers/Auth/            # Auth (Breeze)
│   │   ├── Middleware/
│   │   │   └── AddSecurityHeaders.php   # En-têtes HTTP de sécurité
│   │   └── Requests/                    # Form Requests (validation)
│   │       ├── Concerns/                # Traits partagés entre requests
│   │       ├── StoreActualiteRequest.php
│   │       ├── UpdateActualiteRequest.php
│   │       └── ...
│   ├── Models/                          # Modèles Eloquent (11 modèles)
│   ├── Policies/                        # Politiques d'autorisation (1 par modèle)
│   ├── Services/
│   │   ├── ContactService.php           # Logique du formulaire de contact
│   │   └── UserService.php              # Logique de gestion des utilisateurs
│   ├── Mail/
│   │   └── ContactMessageReceived.php   # Mailable notification contact
│   ├── Support/
│   │   └── HtmlSanitizer.php            # Sanitisation HTML (liste blanche)
│   └── View/Components/
│       ├── AppLayout.php                # Layout public
│       └── GuestLayout.php             # Layout authentification
│
├── config/
│   ├── admin.php                        # Chemin d'accès à l'admin
│   ├── backup.php                       # Configuration des sauvegardes
│   ├── filesystems.php                  # Disques de stockage
│   ├── pages.php                        # Schéma des pages éditables
│   └── permission.php                   # Configuration Spatie Permission
│
├── database/
│   ├── migrations/                      # 15+ migrations
│   ├── factories/                       # Factories pour les 11 modèles
│   └── seeders/
│       ├── DatabaseSeeder.php           # Seeder principal
│       ├── RolePermissionSeeder.php     # Rôles et permissions
│       └── ...
│
├── deploy/
│   └── provision.sh                     # Script de provisionnement VPS
│
├── resources/
│   ├── brand/                           # Logos et assets de marque
│   ├── css/                             # Feuilles de style source
│   ├── img/                             # Images statiques optimisées
│   ├── js/                              # JavaScript source
│   └── views/                           # Templates Blade
│       ├── admin/                       # Vues d'administration
│       ├── actualites/                  # Vues actualités publiques
│       ├── auth/                        # Vues authentification
│       ├── components/                  # Composants Blade réutilisables
│       ├── errors/                      # Pages d'erreur (404, 503...)
│       ├── layouts/                     # Layouts (app, guest, admin)
│       └── ...
│
├── routes/
│   ├── web.php                          # Routes publiques et admin
│   └── auth.php                         # Routes d'authentification
│
└── tests/
    ├── Feature/                         # Tests d'intégration
    └── Unit/                            # Tests unitaires
```

### 3.2 Patterns architecturaux utilisés

| Pattern | Usage dans l'application |
|---------|--------------------------|
| **MVC** | Laravel natif (Models, Views, Controllers) |
| **Form Requests** | Validation découplée dans des classes dédiées |
| **Service Layer** | `ContactService`, `UserService` pour la logique métier complexe |
| **Policies** | Autorisation fine-grained par modèle (1 Policy par modèle) |
| **Traits (Concerns)** | Comportements réutilisables : `Publishable`, `HasUniqueSlug`, `HasImageUrl` |
| **Blade Components** | Composants de vue réutilisables (layout, inputs, champs admin) |
| **Repository-lite** | Scopes Eloquent pour les requêtes courantes (`scopePublished()`) |

---

## 4. Schéma de base de données

### 4.1 Modèle entité-relation

```
users ─────────────────────────────┐
  id (PK)                          │ uploaded_by (FK)
  name                             ▼
  email (UNIQUE)             media ─────── contact_messages (cv uploaded_by)
  password                   id (PK)
  email_verified_at          disk
  remember_token             path
                             original_name
                             mime_type
                             size
                             alt_text
                             uploaded_by → users.id

actualites               offres                  gallery_images
  id (PK)                  id (PK)                 id (PK)
  title                    title                   title
  slug (UNIQUE, INDEX)     slug (UNIQUE, INDEX)    caption
  category                 tags (JSON)             image
  excerpt                  summary                 position
  body (LONGTEXT)          missions (JSON)
  image                    profile (JSON)
  published_at (INDEX)     published_at (INDEX)

pages                content_blocks          realisations
  id (PK)              id (PK)                id (PK)
  slug (UNIQUE)        group (INDEX)          title
  content (JSON)       icon                   slug (UNIQUE)
                       title                  category
                       description            description
                       meta (JSON)            image
                       position               facts (JSON)
                                              tags (JSON)
milestones            site_settings           position
  id (PK)              id (PK)                published_at
  year_label           contact_address
  category             contact_phone
  title                contact_email
  description          founding_year
  position             rigs_count
                       incidents_count

-- Tables Spatie Permission --
roles | permissions | model_has_roles | model_has_permissions | role_has_permissions

-- Tables Laravel --
sessions | cache | jobs | password_reset_tokens
```

### 4.2 Détail des tables principales

#### Table `actualites`

```sql
CREATE TABLE actualites (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    title       VARCHAR(255) NOT NULL,
    slug        VARCHAR(255) NOT NULL UNIQUE,
    category    VARCHAR(255) NOT NULL,
    excerpt     TEXT NOT NULL,
    body        LONGTEXT NOT NULL,
    image       VARCHAR(255) NULL,
    published_at TIMESTAMP NULL,
    created_at  TIMESTAMP,
    updated_at  TIMESTAMP
);
CREATE INDEX idx_actualites_slug ON actualites(slug);
CREATE INDEX idx_actualites_published_at ON actualites(published_at);
```

#### Table `pages`

```sql
CREATE TABLE pages (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    slug       VARCHAR(255) NOT NULL UNIQUE,
    content    JSON NOT NULL,           -- Structure variable selon config/pages.php
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

Le champ `content` est un objet JSON dont la structure est dictée par le fichier `config/pages.php`. Accès via dot notation : `$page->content['hero']['title']`.

#### Table `content_blocks`

```sql
CREATE TABLE content_blocks (
    id          INTEGER PRIMARY KEY AUTOINCREMENT,
    group       VARCHAR(255) NOT NULL,  -- 'trades', 'hse_metrics', 'equipment_specs'...
    icon        VARCHAR(255) NOT NULL,  -- Classe CSS Hugeicons
    title       VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    meta        JSON NULL,
    position    INTEGER DEFAULT 0,
    created_at  TIMESTAMP,
    updated_at  TIMESTAMP
);
CREATE INDEX idx_content_blocks_group ON content_blocks(group);
```

---

## 5. Routes et API

### 5.1 Routes publiques

```php
// HomeController
GET  /                          → HomeController@index

// Pages institutionnelles
GET  /a-propos                  → AboutController@index
GET  /metiers                   → MetierController@index
GET  /hse                       → HseController@index
GET  /equipements               → EquipementController@index

// Actualités
GET  /actualites                → ActualiteController@index
GET  /actualites/{actualite}    → ActualiteController@show   (route key: slug)

// Carrières
GET  /carrieres                 → CarriereController@index
GET  /carrieres/offres/{offre}  → OffreController@show       (route key: slug)

// Galerie
GET  /galerie                   → GalleryController@index

// Contact
GET  /contact                   → ContactController@show
POST /contact                   → ContactController@store    (rate limit: 5/min)

// SEO
GET  /sitemap.xml               → SeoController@sitemap
GET  /robots.txt                → SeoController@robots

// Pages légales
GET  /mentions-legales
GET  /politique-de-confidentialite
GET  /cookies
```

### 5.2 Routes d'authentification

```php
GET  /login                     → Auth\AuthenticatedSessionController@create
POST /login                     → Auth\AuthenticatedSessionController@store
POST /logout                    → Auth\AuthenticatedSessionController@destroy

GET  /forgot-password           → Auth\PasswordResetLinkController@create
POST /forgot-password           → Auth\PasswordResetLinkController@store

GET  /reset-password/{token}    → Auth\NewPasswordController@create
POST /reset-password            → Auth\NewPasswordController@store
```

### 5.3 Routes d'administration

Toutes les routes admin sont préfixées par la valeur de `config('admin.path')` (défaut : `admin`) et protégées par le middleware `auth` et `verified`.

```php
// Tableau de bord
GET  /admin/                    → Admin\DashboardController@index

// Ressources CRUD (sauf show)
/admin/actualites               → Admin\ActualiteController
/admin/offres                   → Admin\OffreController
/admin/gallery                  → Admin\GalleryImageController
/admin/realisations             → Admin\RealisationController
/admin/milestones               → Admin\MilestoneController
/admin/content-blocks           → Admin\ContentBlockController

// Pages (edit/update uniquement)
GET  /admin/pages               → Admin\PageController@index
GET  /admin/pages/{page}/edit   → Admin\PageController@edit  (route key: slug)
PATCH /admin/pages/{page}       → Admin\PageController@update

// Médias (index, store, destroy uniquement)
GET  /admin/media               → Admin\MediaController@index
POST /admin/media               → Admin\MediaController@store
DELETE /admin/media/{media}     → Admin\MediaController@destroy

// Messages (index, show, destroy + download CV)
GET  /admin/messages            → Admin\ContactMessageController@index
GET  /admin/messages/{message}  → Admin\ContactMessageController@show
DELETE /admin/messages/{message}→ Admin\ContactMessageController@destroy
GET  /admin/messages/{message}/cv → Admin\ContactMessageController@downloadCv

// Utilisateurs
/admin/users                    → Admin\UserController

// Paramètres (singleton)
GET  /admin/settings/edit       → Admin\SiteSettingController@edit
PUT  /admin/settings            → Admin\SiteSettingController@update
```

---

## 6. Modèles et logique métier

### 6.1 Trait `Publishable`

```php
// Filtre les enregistrements dont published_at est dans le passé
scope public function scopePublished(Builder $query): Builder
{
    return $query->whereNotNull('published_at')
                 ->where('published_at', '<=', now());
}
```

**Modèles utilisant ce trait :** `Actualite`, `Offre`, `Realisation`

### 6.2 Trait `HasUniqueSlug`

Génère automatiquement un slug unique depuis le titre :
- Translittère les accents (é → e, ç → c, etc.)
- Convertit en minuscules avec tirets
- En cas de collision, ajoute un suffixe numérique (`-2`, `-3`, etc.)
- Configure le route model binding sur `slug` (pas `id`)

### 6.3 Trait `HasImageUrl`

Accesseur `$model->image_url` abstrayant deux stratégies :
1. **Image uploadée** : URL via disque de stockage public (`Storage::url($path)`)
2. **Image statique** : URL via assets Vite (`asset('img/opt/' . $filename)`)

### 6.4 Service `ContactService`

Encapsule le flux de traitement d'un message de contact :
1. Sauvegarde le fichier CV dans `storage/app/private/cv/`
2. Crée un enregistrement `ContactMessage` en base
3. Dispatche le mailable `ContactMessageReceived` (avec CV en pièce jointe)

### 6.5 `HtmlSanitizer`

Nettoie le HTML produit par l'éditeur Quill avant stockage :

**Balises autorisées :** `<p>`, `<br>`, `<strong>`, `<em>`, `<ul>`, `<ol>`, `<li>`, `<blockquote>`, `<a href>`, `<h2>`, `<h3>`

Toute autre balise ou attribut est supprimé. Prévient les attaques XSS stockées.

---

## 7. Authentification et autorisation

### 7.1 Authentification

Basée sur **Laravel Breeze** avec sessions PHP. Sessions stockées en base de données (table `sessions`).

Configuration clé dans `.env` :
```env
SESSION_DRIVER=database
SESSION_LIFETIME=120
BCRYPT_ROUNDS=12
```

### 7.2 Rôles et permissions (Spatie)

**Rôles :**

| Rôle | Description |
|------|-------------|
| `admin` | Accès total à toutes les ressources |
| `editor` | Accès au contenu, pas à la gestion des utilisateurs ni paramètres |

**Permissions définies (`RolePermissionSeeder`) :**

```php
// Permissions partagées admin + éditeur
$contentPermissions = [
    'manage actualites',
    'manage offres',
    'manage gallery',
    'manage media',
    'manage pages',
    'manage content-blocks',
    'manage realisations',
    'manage milestones',
    'view messages',
    'delete messages',
];

// Permissions admin uniquement
$adminPermissions = [
    'manage users',
    'manage roles',
    'manage settings',
];
```

### 7.3 Policies

Chaque modèle dispose d'une Policy Laravel (`app/Policies/`) qui délègue la vérification à `$user->can('permission_name')` via Spatie.

**Exemple — `ActualitePolicy` :**
```php
public function viewAny(User $user): bool   → $user->can('manage actualites')
public function create(User $user): bool    → $user->can('manage actualites')
public function update(User $user, ...): bool → $user->can('manage actualites')
public function delete(User $user, ...): bool → $user->can('manage actualites')
```

---

## 8. Gestion des médias et fichiers

### 8.1 Disques de stockage configurés

```php
// config/filesystems.php
'disks' => [
    'local'         => storage_path('app/private'),      // Fichiers privés (CV)
    'public'        => storage_path('app/public'),       // Fichiers publics (images)
    'local_backups' => storage_path('app/backups'),      // Sauvegardes locales
    's3'            => [/* Config AWS */],                // Sauvegardes cloud
]
```

### 8.2 Lien symbolique

```bash
# Rend storage/app/public/ accessible via /storage/
php artisan storage:link
```

**Important :** Cette commande doit être exécutée à chaque déploiement frais.

### 8.3 CV des candidats

- Stockés dans `storage/app/private/cv/` (non accessible publiquement)
- Téléchargés via le contrôleur admin (`ContactMessageController@downloadCv`)
- Le contrôleur vérifie l'autorisation avant de servir le fichier via `Storage::download()`

---

## 9. Frontend et assets

### 9.1 Organisation des feuilles de style

```
resources/css/
├── app.css          # Import Tailwind + styles globaux
├── admin.css        # Styles spécifiques à l'interface admin
├── components.css   # Composants réutilisables
├── responsive.css   # Media queries supplémentaires
├── style.css        # Styles du site public (couleurs, typographie SFP)
└── splash.css       # Écran de chargement initial
```

### 9.2 Organisation JavaScript

```
resources/js/
├── app.js           # Point d'entrée principal (importe Alpine.js)
├── bootstrap.js     # Configuration Axios
├── site.js          # Interactions spécifiques au site public
└── admin.js         # Interactions spécifiques à l'interface admin
                     # (initialisation Quill, Tagify, Notyf)
```

### 9.3 Configuration Vite

```javascript
// vite.config.js
export default defineConfig({
    plugins: [
        laravel({ input: ['resources/css/app.css', 'resources/js/app.js'] }),
        tailwindcss(),
    ],
});
```

### 9.4 Commandes de build

```bash
npm run dev      # Serveur de développement avec HMR (Hot Module Replacement)
npm run build    # Build de production (minification, hash de fichiers)
```

---

## 10. Configuration de l'environnement

### 10.1 Variables d'environnement complètes

```env
# === Application ===
APP_NAME="SFP"
APP_ENV=production          # local | staging | production
APP_KEY=base64:...          # php artisan key:generate
APP_DEBUG=false             # TOUJOURS false en production
APP_URL=https://votre-domaine.com
APP_LOCALE=fr

# === Administration ===
ADMIN_PATH=admin            # Segment URL de l'admin (modifiable pour sécurité)

# === Base de données ===
DB_CONNECTION=sqlite        # sqlite | mysql | mariadb | pgsql
# Pour SQLite (défaut)
DB_DATABASE=/chemin/absolu/vers/database/database.sqlite
# Pour MySQL/MariaDB
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=sfp_db
# DB_USERNAME=sfp_user
# DB_PASSWORD=mot-de-passe-securise

# === Sessions et Cache ===
SESSION_DRIVER=database
SESSION_LIFETIME=120
CACHE_STORE=database

# === File d'attente ===
QUEUE_CONNECTION=database

# === E-mail ===
MAIL_MAILER=smtp
MAIL_HOST=smtp.votre-fournisseur.com
MAIL_PORT=587
MAIL_USERNAME=no-reply@sfp.cg
MAIL_PASSWORD=mot-de-passe-smtp
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@sfp.cg
MAIL_FROM_NAME="SFP - Société de Forages Pétroliers"
MAIL_ADMIN_ADDRESS=contact@sfp.cg    # Destinataire des notifications

# === Sécurité ===
BCRYPT_ROUNDS=12

# === Sauvegardes ===
BACKUP_NAME=SFP
BACKUP_ARCHIVE_PASSWORD=mot-de-passe-archive

# === AWS S3 (optionnel) ===
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=eu-west-1
AWS_BUCKET=sfp-backups
```

---

## 11. Installation et déploiement

### 11.1 Prérequis serveur

| Composant | Version minimale | Recommandée |
|-----------|-----------------|-------------|
| PHP | 8.2 | 8.5 |
| Extensions PHP | BCMath, Ctype, cURL, DOM, Fileinfo, JSON, Mbstring, OpenSSL, PDO, SQLite3 (ou MySQL), Tokenizer, XML, Zip | — |
| Composer | 2.x | Dernière version |
| Node.js | 20.x | LTS actuelle |
| npm | 10.x | — |
| Nginx ou Apache | — | Nginx recommandé |

### 11.2 Installation en développement

```bash
# 1. Cloner le dépôt
git clone [url-du-depot] sfp_website
cd sfp_website

# 2. Installer les dépendances PHP
composer install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Créer la base de données (SQLite)
touch database/database.sqlite

# 5. Exécuter les migrations et seeders
php artisan migrate --seed

# 6. Créer l'administrateur initial
php artisan create:admin-user

# 7. Créer le lien symbolique de stockage
php artisan storage:link

# 8. Installer les dépendances frontend
npm install

# 9. Démarrer les serveurs de développement
composer run dev
# ou séparément :
php artisan serve
npm run dev
```

### 11.3 Déploiement sur VPS (automatisé)

Le script `deploy/provision.sh` automatise l'installation complète sur un VPS Ubuntu/Debian :

```bash
# Copier le script sur le serveur
scp deploy/provision.sh user@[ip-serveur]:/tmp/

# Exécuter sur le serveur
ssh user@[ip-serveur]
sudo bash /tmp/provision.sh
```

**Ce que fait le script :**
1. Met à jour les paquets système
2. Installe Nginx, PHP 8.3 + extensions, Composer, Node.js
3. Clone l'application dans `/var/www/sfp_website`
4. Configure le `.env` de production
5. Exécute `composer install --no-dev --optimize-autoloader`
6. Exécute les migrations (`php artisan migrate --force`)
7. Exécute `npm run build`
8. Configure Nginx avec l'hôte virtuel approprié
9. Installe un certificat HTTPS Let's Encrypt (Certbot)
10. Configure les permissions de fichiers
11. Met en place la crontab pour les sauvegardes

### 11.4 Déploiement manuel (hébergement mutualisé)

1. **Construire les assets localement :**
   ```bash
   npm run build
   ```

2. **Uploader les fichiers via FTP/SFTP** (exclure : `node_modules/`, `storage/`, `.env`)

3. **Configurer le DocumentRoot** sur le répertoire `public/` de l'application

4. **Créer le fichier `.env`** sur le serveur (copier `.env.example`, renseigner les valeurs)

5. **Exécuter en SSH :**
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan key:generate
   php artisan migrate --force
   php artisan storage:link
   php artisan db:seed
   php artisan optimize
   ```

6. **Configurer la crontab** (voir section Sauvegarde)

### 11.5 Commandes post-déploiement

```bash
# Toujours exécuter après une mise à jour du code
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
npm run build    # Si le frontend a changé
```

### 11.6 Créer le premier administrateur

```bash
php artisan create:admin-user
```

La commande demande interactivement le nom, l'e-mail et le mot de passe du premier compte administrateur.

---

## 12. Sauvegardes automatiques

### 12.1 Configuration (`config/backup.php`)

```php
'source' => [
    'files' => [
        'include' => [
            storage_path('app/public'),
            storage_path('app/private'),
        ],
    ],
    'databases' => ['sqlite'],   // ou 'mysql', 'pgsql'
],
'destination' => [
    'disks' => ['local_backups', 's3'],
    'filename_prefix' => '',
],
'backup' => [
    'password' => env('BACKUP_ARCHIVE_PASSWORD'),
    'encryption' => 'default',
],
```

### 12.2 Rétention

```php
'cleanup' => [
    'defaultStrategy' => [
        'keepAllBackupsForDays'          => 7,
        'keepDailyBackupsForDays'        => 30,
        'keepWeeklyBackupsForWeeks'      => 8,
        'keepMonthlyBackupsForMonths'    => 6,
        'keepYearlyBackupsForYears'      => 2,
        'deleteOldestBackupsWhenUsingMoreMegabytesThan' => 5000,
    ],
],
```

### 12.3 Planification

```php
// routes/console.php
Schedule::command('backup:clean')->dailyAt('01:00');
Schedule::command('backup:run')->dailyAt('02:00');
```

---

## 13. Suite de tests

### 13.1 Configuration

- **Framework :** Pest v4 (surcouche PHPUnit)
- **Base de données de test :** SQLite en mémoire (`:memory:`)
- **Configuration :** `phpunit.xml`

### 13.2 Exécution des tests

```bash
# Tous les tests
php artisan test --compact

# Fichier spécifique
php artisan test tests/Feature/ActualiteTest.php

# Filtre par nom
vendor/bin/pest --filter="can create article"

# Avec couverture de code
vendor/bin/pest --coverage
```

### 13.3 Structure des tests

```
tests/
├── Feature/
│   ├── Auth/                  # Tests d'authentification
│   ├── Admin/                 # Tests de l'interface admin (CRUD)
│   ├── ContactFormTest.php    # Tests formulaire de contact
│   ├── ActualiteTest.php      # Tests affichage actualités
│   └── ...
└── Unit/
    ├── HtmlSanitizerTest.php  # Tests sanitisation HTML
    └── ...
```

### 13.4 Factories disponibles

Chaque modèle dispose d'une factory (`database/factories/`) permettant de créer des données de test :

```php
// Exemples d'utilisation dans les tests
$user = User::factory()->create(['role' => 'admin']);
$actualite = Actualite::factory()->published()->create();
$offre = Offre::factory()->draft()->create();
```

---

## 14. Maintenance et opérations

### 14.1 Commandes de maintenance courantes

```bash
# Effacer tous les caches
php artisan optimize:clear

# Rebuilder les caches de production
php artisan optimize

# Mettre en maintenance
php artisan down

# Sortir de maintenance
php artisan up

# Vérifier les sauvegardes
php artisan backup:monitor

# Créer une sauvegarde immédiate
php artisan backup:run

# Vérifier la santé générale de l'application
php artisan about
```

### 14.2 Logs

Les logs de l'application sont dans `storage/logs/laravel.log`.

```bash
# Consulter les dernières erreurs
tail -n 100 storage/logs/laravel.log

# Chercher les erreurs 500
grep "ERROR" storage/logs/laravel.log | tail -20

# Utiliser le viewer de logs (développement)
php artisan pail
```

### 14.3 Mise à jour de l'application

```bash
# 1. Activer le mode maintenance
php artisan down

# 2. Sauvegarder
php artisan backup:run

# 3. Mettre à jour le code (git ou FTP)
git pull origin main

# 4. Mettre à jour les dépendances
composer install --no-dev --optimize-autoloader
npm install
npm run build

# 5. Exécuter les nouvelles migrations
php artisan migrate --force

# 6. Vider et reconstruire les caches
php artisan optimize

# 7. Désactiver la maintenance
php artisan up
```

### 14.4 Permissions fichiers recommandées (Linux)

```bash
# Propriétaire : utilisateur web (www-data, nginx, apache...)
chown -R www-data:www-data /var/www/sfp_website

# Permissions des répertoires
find /var/www/sfp_website -type d -exec chmod 755 {} \;

# Permissions des fichiers
find /var/www/sfp_website -type f -exec chmod 644 {} \;

# Le répertoire storage et bootstrap/cache doivent être accessibles en écriture
chmod -R 775 storage/ bootstrap/cache/
```

---

## 15. Dépendances et licences

| Package | Licence |
|---------|---------|
| Laravel Framework | MIT |
| Tailwind CSS | MIT |
| Alpine.js | MIT |
| Quill | BSD-3-Clause |
| Tagify | MIT |
| Notyf | MIT |
| Spatie Laravel Permission | MIT |
| Spatie Laravel Backup | MIT |
| Pest PHP | MIT |
| Hugeicons | CC BY 4.0 / Commercial (selon plan) |

> Vérifiez les licences avant tout usage commercial des icônes Hugeicons et des polices de caractères utilisées.

---

*Documentation Technique — SFP Website v1.0 — Septembre 2025*
