# SFP · Société de Forages Pétroliers — Site institutionnel

Site vitrine de la **SFP** (Société de Forages Pétroliers), filiale du groupe **SNPC**, construit avec [Laravel](https://laravel.com) et [Tailwind CSS](https://tailwindcss.com).

## Pages du site

- **Accueil** — présentation de l'entreprise, métiers, HSE, équipements, galerie, actualités, contact
- **Actualités** — liste et détail des actualités de l'entreprise
- **Carrières** — offres d'emploi et formulaire de candidature

## Pour les développeurs

Prérequis : PHP 8.2+, Composer, Node.js 18+.

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

npm run build      # ou `npm run dev` pendant le développement
php artisan serve
```

Le site est servi sur `http://localhost:8000`.

Aucune base de données n'est requise pour faire fonctionner le site dans son état actuel (le contenu des actualités et des offres d'emploi est géré dans `app/Support/Content/`). SQLite est configuré par défaut si besoin.

## Déploiement en production

Pour mettre le site en ligne chez un hébergeur, suivez le guide pas-à-pas destiné à un non-développeur : **[DEPLOIEMENT.md](DEPLOIEMENT.md)**.

Pour un déploiement automatisé sur un serveur (VPS) neuf, voir les scripts `deploy/provision.sh`
(installation complète : Nginx, PHP, HTTPS) et `deploy/deploy.sh` (mises à jour), documentés dans
[DEPLOIEMENT.md](DEPLOIEMENT.md#déploiement-sur-un-serveur-neuf-vps--méthode-automatisée).

## Charte graphique

Les ressources de marque (logo, charte graphique, plaquette commerciale) se trouvent dans `resources/brand/`.
