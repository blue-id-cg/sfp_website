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
   - Extensions PHP : `mbstring`, `openssl`, `PDO`, `pdo_sqlite`, `tokenizer`, `xml`, `ctype`, `fileinfo`
   - Un accès **SSH** (terminal) — quasiment tous les hébergeurs sérieux le proposent, même sur les offres mutualisées (souvent à activer dans le panneau de configuration)
3. Les identifiants d'accès à l'hébergement (cPanel, ou accès SSH/FTP) fournis par votre hébergeur.

> Ce site n'a **pas besoin** d'une base de données MySQL pour fonctionner : il utilise un simple fichier
> (SQLite) qui ne demande aucune configuration particulière chez l'hébergeur.

---

## Quelle méthode choisir ?

Il y a deux façons de mettre le site en ligne. Choisissez celle qui correspond à ce que vous avez acheté :

| Vous avez... | Méthode | Section |
| --- | --- | --- |
| Un **hébergement mutualisé** (cPanel, offre "hébergement web" classique) | Suivez les étapes 1 à 5 ci-dessous, à la main | [Étape 1](#étape-1--préparer-les-fichiers-du-site-sur-votre-ordinateur) |
| Un **serveur privé (VPS) tout neuf**, sans rien d'installé dessus | Utilisez le script automatisé fourni | [Déploiement sur un serveur neuf (VPS)](#déploiement-sur-un-serveur-neuf-vps--méthode-automatisée) |

Si vous ne savez pas ce que vous avez acheté : un hébergement où on vous donne accès à un "cPanel" avec
une interface graphique est un **mutualisé**. Un accès où vous recevez seulement une adresse IP et un mot
de passe root, sans aucune interface, est un **VPS vierge**.

---

## Déploiement sur un serveur neuf (VPS) — méthode automatisée

Cette méthode s'adresse à un serveur **totalement vide** (ex. une nouvelle instance chez un fournisseur
comme OVH, Contabo, DigitalOcean, Hetzner...), sous Ubuntu ou Debian, sur lequel rien n'est encore installé.
Un script fourni dans le projet (`deploy/provision.sh`) automatise toute l'installation.

> Cette étape technique (connexion en root à un serveur Linux) est plus confortable si elle est réalisée
> par votre développeur ou une personne à l'aise avec un terminal. Une fois faite, les mises à jour
> suivantes redeviennent simples (voir plus bas).

### Ce que fait le script, en résumé

En une seule exécution, `provision.sh` :

1. Met à jour le système et installe **Nginx** (le serveur web) et **PHP 8.3** avec les extensions requises.
2. Installe **Composer** (gestionnaire de dépendances PHP) et **Node.js** (pour compiler le CSS/JS).
3. Récupère les fichiers du site (soit depuis un dépôt Git, soit depuis des fichiers déjà envoyés sur le
   serveur).
4. Installe les dépendances du projet et compile les fichiers CSS/JS finaux.
5. Crée et configure le fichier `.env` (mode production, nom de domaine).
6. Configure les bonnes permissions de fichiers.
7. Crée la configuration Nginx pour votre nom de domaine, pointée automatiquement vers le bon dossier
   (`public/`).
8. Installe un certificat **HTTPS gratuit** (Let's Encrypt) pour votre domaine.

À la fin, le site est en ligne, en HTTPS, à l'adresse de votre domaine.

### Prérequis avant de lancer le script

1. Un serveur Ubuntu ou Debian tout neuf, avec un accès `root` par SSH.
2. Un nom de domaine dont le **DNS (enregistrement A)** pointe déjà vers l'adresse IP de ce serveur —
   sans ça, l'étape du certificat HTTPS échouera (le script continuera quand même, vous pourrez relancer
   cette étape plus tard une fois le DNS propagé).

### Utilisation

Connectez-vous en SSH au serveur en `root`, puis :

```bash
# Si les fichiers du projet sont déjà sur le serveur (ex. envoyés en FTP dans /var/www/sfp_website) :
sudo bash provision.sh votre-domaine.com

# Ou, si le projet est disponible dans un dépôt Git :
sudo bash provision.sh votre-domaine.com https://github.com/votre-org/sfp_website.git
```

Le script affiche sa progression étape par étape (`[1/9]`, `[2/9]`, ...). Une fois terminé, ouvrez
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

---

## Étape 4 — Finaliser l'installation sur le serveur

Toujours en SSH, dans le dossier du projet, lancez ces commandes une par une :

```bash
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Puis vérifiez les autorisations d'écriture (nécessaire pour que le site fonctionne) :

```bash
chmod -R 775 storage bootstrap/cache
```

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
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

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

*Pour toute modification du contenu (textes, offres d'emploi, actualités) au-delà de simples corrections
de texte, ou pour brancher un vrai système d'envoi d'e-mails sur le formulaire de contact, faites appel à
votre développeur.*
