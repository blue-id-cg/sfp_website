# Guide de mise en ligne du site SFP (pour non-développeur)

Ce guide explique, étape par étape, comment mettre le site en ligne chez un hébergeur.
Il est écrit pour une personne qui n'a jamais fait ça — prenez votre temps, chaque étape est courte.

Si un point bloque, contactez la personne qui a développé le site : mieux vaut poser une question
que de forcer une étape.

---

## Ce qu'il vous faut avant de commencer

1. **Un nom de domaine** (ex. `www.sfp-congo.com`), acheté chez un registrar (ex. OVH, Namecheap, un hébergeur local).
2. **Un hébergement web** qui supporte PHP. Demandez à votre hébergeur de confirmer :
    - PHP version **8.2 ou plus récent**
    - Extensions PHP : `mbstring`, `openssl`, `PDO`, `tokenizer`, `xml`, `ctype`, `fileinfo`, plus une des
      suivantes selon la base de données choisie (voir juste en dessous) : `pdo_sqlite`, `pdo_mysql` ou
      `pdo_pgsql`
    - Un accès **SSH** (terminal) — quasiment tous les hébergeurs sérieux le proposent, même sur les offres mutualisées (souvent à activer dans le panneau de configuration)
3. Les identifiants d'accès à l'hébergement (cPanel, ou accès SSH/FTP) fournis par votre hébergeur.

### Quelle base de données utiliser ?

Ce site peut fonctionner avec **quatre** moteurs de base de données, au choix :

| Moteur                  | Quand le choisir                                                                                                                                                                            |
| ----------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **SQLite** (par défaut) | Le plus simple : un seul fichier, aucune installation ni configuration chez l'hébergeur. Convient très bien à ce site (peu d'écritures : offres d'emploi, actualités, messages de contact). |
| **MySQL**               | Si votre hébergement mutualisé (cPanel) ne propose que du MySQL — c'est le cas le plus courant chez les hébergeurs mutualisés classiques.                                                   |
| **MariaDB**             | Équivalent de MySQL (même usage, même commandes), souvent installé par défaut sur les VPS Ubuntu/Debian récents.                                                                            |
| **PostgreSQL**          | Si vous ou votre hébergeur préférez PostgreSQL, ou en cas de besoin de montée en charge plus poussée (voir la fin de ce guide).                                                             |

> **En résumé :** ne changez rien si vous ne savez pas — SQLite fonctionne très bien pour ce site.
> Ne choisissez MySQL/MariaDB/PostgreSQL que si votre hébergeur l'impose (mutualisé) ou si vous savez
> pourquoi vous en avez besoin (voir [Peut-on encore améliorer / faire évoluer le site ?](#peut-on-encore-améliorer--faire-évoluer-le-site-)).

---

## Quelle méthode choisir ?

Il y a deux façons de mettre le site en ligne. Choisissez celle qui correspond à ce que vous avez acheté :

| Vous avez...                                                             | Méthode                                       | Section                                                                                            |
| ------------------------------------------------------------------------ | --------------------------------------------- | -------------------------------------------------------------------------------------------------- |
| Un **hébergement mutualisé** (cPanel, offre "hébergement web" classique) | Suivez les étapes 1 à 5 ci-dessous, à la main | [Étape 1](#étape-1--préparer-les-fichiers-du-site-sur-votre-ordinateur)                            |
| Un **serveur privé (VPS) tout neuf**, sans rien d'installé dessus        | Utilisez le script automatisé fourni          | [Déploiement sur un serveur neuf (VPS)](#déploiement-sur-un-serveur-neuf-vps--méthode-automatisée) |

Si vous ne savez pas ce que vous avez acheté : un hébergement où on vous donne accès à un "cPanel" avec
une interface graphique est un **mutualisé**. Un accès où vous recevez seulement une adresse IP et un mot
de passe root, sans aucune interface, est un **VPS vierge**.

---

## Déploiement sur un serveur neuf (VPS) — méthode automatisée

Cette méthode s'adresse à un serveur **totalement vide** (ex. une nouvelle instance chez un fournisseur
comme OVH, Contabo, DigitalOcean, Hetzner...), sous Ubuntu ou Debian, sur lequel rien n'est encore installé.
Un script fourni dans le projet (`deploy/provision.sh`) automatise toute l'installation. Il s'appuie sur
d'autres fichiers du même dossier (`deploy/lib.sh`, `deploy/db.sh`, `deploy/laravel.sh`) : lancez-le depuis
une copie complète du projet plutôt que de copier `provision.sh` seul sur le serveur.

> Cette étape technique (connexion en root à un serveur Linux) est plus confortable si elle est réalisée
> par votre développeur ou une personne à l'aise avec un terminal. Une fois faite, les mises à jour
> suivantes redeviennent simples (voir plus bas).

### Ce que fait le script, en résumé

En une seule exécution, `provision.sh` :

1. Met à jour le système et installe **Nginx** (le serveur web) et **PHP 8.3** avec les extensions requises.
2. Installe **Composer** (gestionnaire de dépendances PHP) et **Node.js** (pour compiler le CSS/JS).
3. Récupère les fichiers du site (soit depuis un dépôt Git, soit depuis des fichiers déjà envoyés sur le
   serveur).
4. Installe et configure la **base de données** choisie (SQLite par défaut, ou MySQL/MariaDB/PostgreSQL —
   voir ci-dessous) : installation du serveur si besoin, création de la base et d'un utilisateur dédié.
5. Installe les dépendances du projet et compile les fichiers CSS/JS finaux, puis configure le fichier
   `.env` (mode production, nom de domaine, connexion à la base de données).
6. Exécute les migrations (création des tables) et met en cache la configuration.
7. Configure les bonnes permissions de fichiers.
8. Crée la configuration Nginx pour votre nom de domaine, pointée automatiquement vers le bon dossier
   (`public/`).
9. Installe un certificat **HTTPS gratuit** (Let's Encrypt) pour votre domaine.

À la fin, le site est en ligne, en HTTPS, à l'adresse de votre domaine.

### Prérequis avant de lancer le script

1. Un serveur Ubuntu ou Debian tout neuf, avec un accès `root` par SSH.
2. Un nom de domaine dont le **DNS (enregistrement A)** pointe déjà vers l'adresse IP de ce serveur —
   sans ça, l'étape du certificat HTTPS échouera (le script continuera quand même, vous pourrez relancer
   cette étape plus tard une fois le DNS propagé).

### Utilisation

Connectez-vous en SSH au serveur en `root`, puis, par défaut (base **SQLite**, le plus simple) :

```bash
# Si les fichiers du projet sont déjà sur le serveur (ex. envoyés en FTP dans /var/www/sfp_website) :
sudo bash provision.sh votre-domaine.com

# Ou, si le projet est disponible dans un dépôt Git :
sudo bash provision.sh votre-domaine.com https://github.com/votre-org/sfp_website.git
```

Pour utiliser **MySQL**, **MariaDB** ou **PostgreSQL** à la place (installés et configurés automatiquement
sur ce même serveur), ajoutez la variable `DB_ENGINE` devant la commande :

```bash
# MySQL
sudo DB_ENGINE=mysql bash provision.sh votre-domaine.com https://github.com/votre-org/sfp_website.git

# MariaDB
sudo DB_ENGINE=mariadb bash provision.sh votre-domaine.com https://github.com/votre-org/sfp_website.git

# PostgreSQL
sudo DB_ENGINE=pgsql bash provision.sh votre-domaine.com https://github.com/votre-org/sfp_website.git
```

Le mot de passe de la base est généré automatiquement et enregistré (une seule fois) dans
`/root/sfp_website_db_credentials.txt` sur le serveur à la fin de l'installation — notez-le en lieu sûr
(gestionnaire de mots de passe) puis supprimez ce fichier du serveur.

> Si vous utilisez plutôt une base de données **déjà hébergée ailleurs** (ex. un service managé), voir la
> section [Peut-on encore améliorer / faire évoluer le site ?](#peut-on-encore-améliorer--faire-évoluer-le-site-)
> plus bas — le script sait aussi s'y connecter sans rien installer localement.

Le script affiche sa progression étape par étape (`[1/11]`, `[2/11]`, ...). Une fois terminé, ouvrez
`https://votre-domaine.com` dans un navigateur.

### Mettre à jour le site après ce premier déploiement

Une fois le serveur provisionné, les mises à jour suivantes n'ont plus besoin du script complet :

```bash
cd /var/www/sfp_website
bash deploy/deploy.sh
```

Ce second script récupère les nouveaux fichiers, réinstalle les dépendances si besoin, recompile les
assets et vide les caches — sans toucher à la configuration du serveur (Nginx, HTTPS) déjà en place.

### Lier un site déjà déployé à GitHub (fichiers envoyés à la main au départ)

Si le site a été mis en ligne en envoyant les fichiers directement (FTP/zip) avant qu'un dépôt GitHub
soit disponible, on peut relier le dossier existant sans rien perdre — `.env` et `storage/` ne sont
jamais suivis par Git, ils restent donc intacts :

```bash
cd /var/www/sfp_website        # le dossier contenant le fichier "artisan"

git init
git remote add origin https://github.com/<organisation>/<projet>.git
git fetch origin
git checkout -f main
git branch --set-upstream-to=origin/main main
```

Une fois cette opération faite une seule fois, les mises à jour suivantes se font simplement avec
`bash deploy/deploy.sh` (voir ci-dessus).

---

## Étape 1 — Préparer les fichiers du site sur votre ordinateur

Cette étape se fait une seule fois (et à refaire à chaque mise à jour du design/contenu en dur dans le code).

1. Ouvrez un terminal dans le dossier du projet.
2. Installez les dépendances et générez les fichiers finaux (CSS/JS optimisés) :

    ```bash
    composer install --optimize-autoloader --no-dev
    npm install
    npm run build
    ```

3. Vérifiez qu'un dossier `public/build/` a bien été créé — c'est lui qui contient le CSS et le JavaScript
   prêts pour la mise en ligne.

---

## Étape 2 — Envoyer les fichiers chez l'hébergeur

Deux façons de faire, utilisez celle que votre hébergeur propose :

### Option A — Avec un accès SSH (recommandé)

1. Compressez le dossier du projet en `.zip` (excluez le dossier `node_modules/` s'il existe, il est inutile
   et très volumineux).
2. Envoyez ce fichier `.zip` sur le serveur via l'interface de gestion de fichiers de votre hébergeur
   (souvent appelée "Gestionnaire de fichiers" ou "File Manager"), puis décompressez-le sur place.
3. Connectez-vous en SSH au serveur (votre hébergeur vous donne la commande, généralement de la forme
   `ssh monidentifiant@monserveur.com`).
4. Placez-vous dans le dossier du projet puis lancez :

    ```bash
    composer install --optimize-autoloader --no-dev
    ```

### Option B — Sans SSH (FTP uniquement)

1. Sur votre ordinateur, exécutez d'abord `composer install --optimize-autoloader --no-dev` **avant** l'envoi,
   pour que le dossier `vendor/` soit déjà généré localement.
2. Envoyez tout le dossier du projet (sauf `node_modules/`) via un logiciel FTP (ex. FileZilla) vers le
   serveur.

### Où placer les fichiers exactement

Le point important : **le domaine doit pointer vers le dossier `public/` du projet, pas vers la racine.**

- Si votre hébergeur permet de choisir le "dossier racine du site" (document root), pointez-le vers
  `.../sfp_website/public`.
- Si ce n'est pas possible (certains mutualisés imposent `public_html/` comme racine), demandez à votre
  hébergeur comment faire — la solution standard est de placer tout le projet **en dehors** de
  `public_html/`, et de ne mettre **que le contenu du dossier `public/`** à l'intérieur de `public_html/`,
  en adaptant les deux chemins au tout début du fichier `index.php` de manière à ce qu'ils pointent vers
  le projet. C'est une manipulation technique ponctuelle : si vous n'êtes pas à l'aise, demandez à votre
  hébergeur ou à un développeur de le faire une fois — ça ne prend que quelques minutes.

---

## Étape 3 — Configurer le fichier `.env`

Ce fichier contient les réglages du site (nom de domaine, mode production, etc.).

1. Sur le serveur, dupliquez `.env.example` en `.env` (si ce n'est pas déjà fait) :

    ```bash
    cp .env.example .env
    ```

2. Ouvrez `.env` et modifiez la ligne suivante avec votre vrai nom de domaine :

    ```
    APP_URL=https://www.sfp-congo.com
    ```

3. Vérifiez que ces deux lignes sont bien présentes (elles désactivent l'affichage des erreurs techniques
   aux visiteurs) :

    ```
    APP_ENV=production
    APP_DEBUG=false
    ```

4. Générez la clé de sécurité de l'application (obligatoire, une seule fois) :

    ```bash
    php artisan key:generate
    ```

5. **Si votre hébergeur mutualisé impose MySQL** (cas le plus fréquent sur cPanel — beaucoup
   d'hébergeurs mutualisés ne proposent pas SQLite), créez une base de données MySQL depuis cPanel :
   ouvrez **"Bases de données MySQL"**, créez une base, un utilisateur, et associez l'utilisateur à la
   base avec **tous les privilèges**. cPanel préfixe généralement les noms (ex. `monlogin_sfp`,
   `monlogin_sfpuser`). Reportez ensuite ces informations dans `.env` :

    ```
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=monlogin_sfp
    DB_USERNAME=monlogin_sfpuser
    DB_PASSWORD=le-mot-de-passe-choisi
    ```

    (Pour PostgreSQL, remplacez par `DB_CONNECTION=pgsql` et `DB_PORT=5432` — mêmes autres champs. Si
    votre hébergeur vous laisse SQLite, ne touchez à rien : c'est déjà la configuration par défaut.)

---

## Étape 4 — Finaliser l'installation sur le serveur

Toujours en SSH, dans le dossier du projet :

Si vous êtes en **SQLite** (par défaut) et que le fichier `database/database.sqlite` n'existe pas encore,
créez-le d'abord :

```bash
mkdir -p database
touch database/database.sqlite
```

Le dossier et le fichier doivent être accessibles en écriture par PHP-FPM :

```bash
chmod 775 database
chmod 664 database/database.sqlite
```

Sur un VPS où PHP-FPM fonctionne avec `www-data`, appliquez aussi la propriété du fichier :

```bash
sudo chown www-data:www-data database database/database.sqlite
```

Si le site affiche `attempt to write a readonly database`, exécutez ces trois commandes depuis
`/var/www/sfp_website`, puis rechargez la page. Les scripts automatisés appliquent désormais ces droits
avant les migrations.

Puis lancez ces commandes une par une :

```bash
php artisan migrate --force
php artisan db:seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

> La commande `migrate` crée les tables dont le site a besoin (offres d'emploi, actualités, messages de
> contact...) dans la base de données. Elle est indispensable au premier déploiement, et à refaire à
> chaque mise à jour qui ajoute de nouvelles fonctionnalités (voir plus bas).
>
> La commande `db:seed` remplit ces tables avec le contenu initial du site (pages, blocs de contenu,
> réalisations, frise chronologique, réglages du site, rôles). **Uniquement au premier déploiement** :
> ne la relancez pas lors des mises à jour suivantes, sinon elle écraserait le contenu déjà modifié
> depuis l'administration (voir l'avertissement plus bas).

Puis vérifiez les autorisations d'écriture (nécessaire pour que le site fonctionne) :

```bash
chmod -R 775 storage bootstrap/cache
```

Enfin, créez votre compte administrateur (celui qui vous servira à vous connecter sur `/login` pour gérer
les actualités, les offres d'emploi, la galerie et les messages reçus) :

```bash
php artisan app:create-admin-user
```

La commande vous demande votre nom, votre email et un mot de passe (saisie masquée). Vous pouvez aussi
fournir ces informations directement, utile pour un script d'installation automatisé :

```bash
php artisan app:create-admin-user --name="Votre Nom" --email="vous@exemple.com" --password="un-mot-de-passe-solide"
```

> **Sécurité (facultatif) :** par défaut, l'administration est accessible sur `/admin`. Pour la rendre plus
> difficile à trouver par un scan automatisé, ajoutez `ADMIN_PATH=un-chemin-difficile-a-deviner` dans le
> fichier `.env`, puis videz le cache de configuration : `php artisan config:clear`. L'administration sera
> alors accessible sur `https://votre-domaine.com/un-chemin-difficile-a-deviner`.

---

## Étape 5 — Vérifier que tout fonctionne

1. Ouvrez votre nom de domaine dans un navigateur (ex. `https://www.sfp-congo.com`).
2. Vérifiez que :
    - La page d'accueil s'affiche avec les images, les couleurs et le logo SFP
    - Le menu (aussi sur mobile) s'ouvre correctement
    - Les pages **Actualités** et **Carrières** s'ouvrent sans erreur
    - Le formulaire de contact, en bas de la page d'accueil, affiche bien un message de confirmation après
      l'envoi
3. Si le cadenas HTTPS n'apparaît pas dans la barre d'adresse, activez le certificat SSL gratuit
   (Let's Encrypt) depuis le panneau de votre hébergeur — presque tous le proposent en un clic.

---

## Mettre à jour le site plus tard

Quand une modification du contenu ou du design est livrée par le développeur :

1. Récupérez les nouveaux fichiers et envoyez-les sur le serveur (mêmes méthodes qu'à l'étape 2).
2. Reconnectez-vous en SSH dans le dossier du projet et relancez :

    ```bash
    composer install --optimize-autoloader --no-dev
    npm install && npm run build
    php artisan migrate --force
    php artisan db:seed --class=RolesAndPermissionsSeeder --force
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

    (Si vous avez déployé via le script `deploy/deploy.sh` sur un VPS provisionné avec `provision.sh`,
    ces commandes sont déjà toutes incluses — voir [plus haut](#mettre-à-jour-le-site-après-ce-premier-déploiement).)

> **Ne relancez jamais `php artisan db:seed --force` (sans `--class=...`) lors d'une mise à jour** : les
> seeders de contenu (pages, blocs, réalisations, frise, actualités, offres, galerie) réécrivent des
> lignes précises et effaceraient les modifications faites depuis l'administration. Seul
> `RolesAndPermissionsSeeder` est sans danger à rejouer — il ne fait que garder les permissions à jour.

---

> Astuce : si une page affiche encore l'ancienne version après une mise à jour, c'est souvent le "cache"
> du site. Les trois commandes `artisan ... :cache` ci-dessus le régénèrent. Vous pouvez aussi forcer un
> rechargement complet dans votre navigateur avec `Ctrl + Maj + R` (ou `Cmd + Maj + R` sur Mac).

---

## Dépannage rapide

**Page blanche ou "erreur 500" à l'ouverture du site**
Vérifiez dans `.env` que `APP_KEY` n'est pas vide (relancez `php artisan key:generate` sinon), et que
les dossiers `storage/` et `bootstrap/cache/` sont accessibles en écriture (`chmod -R 775 storage
bootstrap/cache`).

**Le site s'affiche sans style (pas de couleurs, mise en page cassée)**
Le dossier `public/build/` est manquant ou incomplet : relancez `npm run build` puis renvoyez ce dossier
sur le serveur.

**"Erreur 500" alors que le site s'affichait bien avant, juste après un premier déploiement du CMS**
Les tables existent (`migrate` a fonctionné) mais sont vides : le contenu initial (pages, blocs de
contenu, réalisations, frise, réglages, rôles) n'a jamais été chargé. Lancez une seule fois :
`php artisan db:seed --force`. Voir l'avertissement plus haut : ne relancez plus cette commande sans
`--class=...` par la suite, seulement lors du tout premier déploiement.

**Erreur "could not find driver" ou "SQLSTATE" à l'ouverture du site**
La base de données configurée dans `.env` (`DB_CONNECTION`) ne correspond pas à ce qui est réellement
disponible chez l'hébergeur, ou l'extension PHP correspondante (`pdo_mysql`, `pdo_pgsql`, `pdo_sqlite`)
n'est pas activée — demandez à votre hébergeur de l'activer, ou passez par cPanel > "Sélecteur PHP" >
"Extensions". Vérifiez aussi que `DB_HOST`, `DB_DATABASE`, `DB_USERNAME` et `DB_PASSWORD` correspondent
exactement à ce qui a été créé côté hébergeur (voir Étape 3).

**Erreur "Base table ... doesn't exist" ou une page (actualités, carrières, contact) plante**
Les tables n'ont pas été créées : relancez `php artisan migrate --force` dans le dossier du projet.

**"404 Not Found" sur toutes les pages sauf l'accueil**
Le domaine ne pointe probablement pas vers le bon dossier (`public/`), ou la réécriture d'URL (`.htaccess`
sur Apache) n'est pas activée chez l'hébergeur — contactez leur support technique en leur indiquant que le
site est une application **Laravel**.

**Le formulaire de contact ne semble rien faire**
Vérifiez que le certificat HTTPS est actif : certains navigateurs bloquent silencieusement l'envoi de
formulaires sur un site resté en `http://`.

**`bash deploy/deploy.sh` affiche des erreurs `chmod: Operation not permitted` sur des fichiers dans
`storage/framework/sessions/`**
C'est normal si vous déployez avec un utilisateur (ex. `sfp-dev`) différent de celui qui fait tourner le
site (généralement `www-data`) : ces fichiers de session ont été créés par le serveur web, et votre
utilisateur n'a pas le droit de les modifier. Le script continue quand même et la mise à jour du site
n'est pas affectée. Pour corriger la cause une bonne fois pour toutes (à faire par la personne ayant un
accès `root` au serveur, une seule fois) :

```bash
# à exécuter en root (ou via sudo) sur le serveur
usermod -a -G www-data sfp-dev
chown -R sfp-dev:www-data /var/www/sfp_website/storage /var/www/sfp_website/bootstrap/cache
find /var/www/sfp_website/storage /var/www/sfp_website/bootstrap/cache -type d -exec chmod 2775 {} \;
find /var/www/sfp_website/storage /var/www/sfp_website/bootstrap/cache -type f -exec chmod 664 {} \;
```

Remplacez `sfp-dev` par votre utilisateur de déploiement si différent. Le `2775` sur les dossiers fait
que tout nouveau fichier créé (par le site ou par un futur déploiement) hérite automatiquement du groupe
`www-data`, ce qui évite que ce conflit ne se reproduise. Après cette commande, l'utilisateur de
déploiement doit se reconnecter (nouvelle session SSH) pour que l'appartenance au groupe soit prise en
compte.

---

## Peut-on encore améliorer / faire évoluer le site ?

Pour la taille et le trafic actuels du site, la configuration décrite dans ce guide (un seul serveur,
SQLite ou MySQL/MariaDB/PostgreSQL en local) est largement suffisante. Si le site venait à grossir
beaucoup (trafic important, gestion de comptes utilisateurs, envoi d'e-mails en masse, plusieurs serveurs
pour la fiabilité), voici les évolutions possibles — techniques, donc à faire réaliser par un développeur :

- **Base de données externe / managée** : `provision.sh` sait déjà se connecter à une base hébergée
  ailleurs (AWS RDS, DigitalOcean Managed Database, etc.) en fournissant `DB_HOST`, `DB_DATABASE`,
  `DB_USERNAME`, `DB_PASSWORD` en variables d'environnement — utile pour séparer la base de l'application
  ou passer plusieurs serveurs web.
- **Plusieurs serveurs web derrière un répartiteur de charge** : demande alors une base de données
  partagée (donc MySQL/MariaDB/PostgreSQL plutôt que SQLite, qui est un fichier local à un seul serveur),
  des sessions et un cache partagés (ex. Redis), et un stockage de fichiers partagé (ex. S3) au lieu du
  disque local — les variables `AWS_*` sont déjà présentes dans `.env.example` pour ça.
- **Vrai envoi d'e-mails** : le formulaire de contact utilise actuellement `MAIL_MAILER=log` (les
  e-mails sont écrits dans un fichier journal, pas envoyés) — brancher un service comme Mailgun, SES ou
  un SMTP dédié le rendrait fonctionnel en production.
- **Sauvegardes automatiques** : mettre en place une sauvegarde régulière (cron) de la base de données et
  du dossier `storage/` (fichiers envoyés par le site), avec copie hors du serveur.
- **Déploiement sans coupure et retour arrière rapide** : le script `deploy.sh` actuel met à jour les
  fichiers en place ; un système de déploiement par "releases" (dossiers horodatés + lien symbolique) permet
  de basculer instantanément et de revenir en arrière en cas de souci.
- **Mise en cache et surveillance** : ajouter Redis pour le cache/les sessions, activer OPcache côté PHP,
  et surveiller la disponibilité du site (ex. UptimeRobot, Laravel Pulse) pour être alerté en cas de panne.
- **Intégration continue** : automatiser les tests et le déploiement via GitHub Actions plutôt que de
  lancer `deploy.sh` à la main à chaque mise à jour.

Aucune de ces évolutions n'est nécessaire aujourd'hui — elles ne prennent leur intérêt que si le site
change significativement d'échelle ou d'usage. Discutez-en avec votre développeur le moment venu.

---

_Pour toute modification du contenu (textes, offres d'emploi, actualités) au-delà de simples corrections
de texte, ou pour brancher un vrai système d'envoi d'e-mails sur le formulaire de contact, faites appel à
votre développeur._
