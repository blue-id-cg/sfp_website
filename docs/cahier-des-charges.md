# Cahier des Charges
## Site Web Institutionnel et Système de Gestion de Contenu
### Société de Forages Pétroliers (SFP)

---

**Référence :** SFP-CDC-2025-001  
**Version :** 1.0  
**Date :** Septembre 2025  
**Statut :** Livré  
**Commanditaire :** Société de Forages Pétroliers — Pointe-Noire, République du Congo  

---

## Table des matières

1. [Présentation du projet](#1-présentation-du-projet)
2. [Contexte et enjeux](#2-contexte-et-enjeux)
3. [Objectifs](#3-objectifs)
4. [Périmètre fonctionnel](#4-périmètre-fonctionnel)
5. [Exigences fonctionnelles — Site public](#5-exigences-fonctionnelles--site-public)
6. [Exigences fonctionnelles — Espace d'administration (CMS)](#6-exigences-fonctionnelles--espace-dadministration-cms)
7. [Exigences non-fonctionnelles](#7-exigences-non-fonctionnelles)
8. [Architecture cible](#8-architecture-cible)
9. [Contraintes et hypothèses](#9-contraintes-et-hypothèses)
10. [Livrables attendus](#10-livrables-attendus)

---

## 1. Présentation du projet

### 1.1 Maîtrise d'ouvrage

| Élément | Valeur |
|---------|--------|
| Commanditaire | Société de Forages Pétroliers (SFP) |
| Secteur d'activité | Industrie pétrolière — Forage, complétion, workover |
| Siège | Pointe-Noire, République du Congo |
| Actionnaire | Filiale du groupe SNPC |

### 1.2 Objet du document

Le présent cahier des charges définit l'ensemble des exigences fonctionnelles et techniques pour la réalisation du site web institutionnel de la SFP, incluant un espace public de présentation de l'entreprise et un système de gestion de contenu (CMS) permettant aux équipes internes de maintenir le site sans intervention technique.

---

## 2. Contexte et enjeux

La SFP est une entreprise spécialisée dans les opérations de forage pétrolier, de complétion de puits et de workover en République du Congo. En tant que filiale du groupe SNPC (Société Nationale des Pétroles du Congo), elle opère sur des chantiers à haute exigence technique et sécuritaire.

Afin d'asseoir sa visibilité institutionnelle, d'attirer des talents et de communiquer auprès de ses parties prenantes (clients, partenaires, autorités, candidats), la SFP souhaite disposer d'un site web professionnel, maintenable en interne et représentatif de ses activités.

**Enjeux identifiés :**

- Renforcer l'image de marque et la crédibilité institutionnelle de la SFP
- Offrir une vitrine numérique accessible 24h/24 à ses parties prenantes
- Permettre aux équipes communication de publier des actualités et offres d'emploi sans dépendre de prestataires techniques
- Centraliser les candidatures via un formulaire de contact dédié avec dépôt de CV
- Assurer la pérennité de la plateforme avec des sauvegardes automatiques et une infrastructure robuste

---

## 3. Objectifs

### 3.1 Objectifs stratégiques

- Positionner la SFP comme un acteur structuré et professionnel du secteur pétrolier congolais
- Centraliser la communication institutionnelle sur un canal digital maîtrisé
- Réduire la dépendance aux prestataires externes pour la gestion courante du contenu

### 3.2 Objectifs opérationnels

| Objectif | Indicateur de succès |
|----------|---------------------|
| Présenter l'entreprise, ses métiers et son expertise | Toutes les pages institutionnelles accessibles et à jour |
| Publier des actualités régulièrement | Fonctionnalité de publication avec planification disponible |
| Diffuser des offres d'emploi | Offres créées et visibles par les candidats |
| Recevoir des candidatures | Formulaire fonctionnel avec réception d'e-mail |
| Gérer le contenu sans compétences techniques | Interface CMS accessible à des non-développeurs |
| Sauvegarder automatiquement les données | Sauvegardes quotidiennes vérifiées |

---

## 4. Périmètre fonctionnel

### 4.1 Inclus dans le périmètre

| Domaine | Description |
|---------|-------------|
| Site public | Pages institutionnelles, actualités, galerie, carrières, contact |
| CMS admin | Gestion de tout le contenu du site via interface web |
| Authentification | Connexion sécurisée des administrateurs et éditeurs |
| Gestion des médias | Médiathèque intégrée pour images et fichiers |
| Gestion des rôles | Rôles admin et éditeur avec permissions granulaires |
| SEO technique | Sitemap XML, robots.txt dynamiques |
| Sauvegarde | Sauvegarde automatique de la base de données et des fichiers |
| Formulaire de contact | Formulaire avec pièce jointe (CV) et notification e-mail |
| Déploiement | Scripts de mise en production sur hébergement mutualisé ou VPS |

### 4.2 Hors périmètre

| Domaine | Justification |
|---------|---------------|
| Espace client / extranet | Non demandé — site vitrine uniquement |
| Boutique en ligne / e-commerce | Non applicable au secteur |
| Application mobile native | Non demandé |
| Intégration ERP / SIRH | Non demandé dans cette phase |
| Multilinguisme complet (EN) | Interface publique en français ; traductions partielles hors périmètre |

---

## 5. Exigences fonctionnelles — Site public

### 5.1 Page d'accueil

- **EF-01** : Afficher un bandeau héro avec titre, accroche et bouton d'appel à l'action configurable depuis le CMS
- **EF-02** : Afficher un bloc "Chiffres clés" (année de fondation, nombre de rigs, incidents HSE) configurables
- **EF-03** : Afficher les 3 dernières actualités publiées avec lien vers la liste complète
- **EF-04** : Afficher un aperçu de la galerie photo
- **EF-05** : Afficher les réalisations phares (projets)
- **EF-06** : Afficher des blocs métiers (icône + titre + description) configurables

### 5.2 Pages institutionnelles

- **EF-10** : Page "À propos" — historique, valeurs, gouvernance, chiffres clés
- **EF-11** : Page "Nos métiers" — description des activités (forage, complétion, workover) avec blocs illustrés
- **EF-12** : Page "HSE" — politique santé-sécurité-environnement, indicateurs, engagements
- **EF-13** : Page "Équipements" — présentation du parc matériel avec blocs descriptifs

### 5.3 Actualités

- **EF-20** : Liste paginée des actualités publiées (9 par page), triées par date de publication décroissante
- **EF-21** : Page de détail d'une actualité avec corps HTML enrichi (gras, listes, liens, titres H2/H3)
- **EF-22** : URL basée sur le slug de l'article (ex. : `/actualites/nom-de-larticle`)
- **EF-23** : Affichage d'une image de couverture sur chaque actualité

### 5.4 Carrières

- **EF-30** : Liste des offres d'emploi publiées
- **EF-31** : Page de détail d'une offre avec : titre, résumé, missions (liste), profil requis (liste), compétences (tags)
- **EF-32** : Bouton "Postuler" renvoyant vers le formulaire de contact avec objet pré-rempli

### 5.5 Galerie

- **EF-40** : Galerie photos paginée, ordonnée par position définie dans le CMS
- **EF-41** : Chaque image dispose d'un titre et d'un texte alternatif (accessibilité)

### 5.6 Formulaire de contact

- **EF-50** : Formulaire avec les champs : Nom, E-mail, Téléphone, Objet, Message, CV (fichier, optionnel)
- **EF-51** : Validation des champs côté serveur (e-mail valide, taille de fichier, types autorisés)
- **EF-52** : Envoi d'une notification e-mail à l'administrateur avec les données du formulaire et le CV en pièce jointe
- **EF-53** : Limitation du taux d'envoi (5 soumissions par minute par adresse IP) pour prévenir le spam
- **EF-54** : Affichage d'un message de confirmation à l'utilisateur après envoi réussi

### 5.7 Pages légales et SEO

- **EF-60** : Page "Mentions légales"
- **EF-61** : Page "Politique de confidentialité"
- **EF-62** : Page "Cookies"
- **EF-63** : Génération dynamique du fichier `sitemap.xml` incluant toutes les pages publiées
- **EF-64** : Génération dynamique du fichier `robots.txt`

---

## 6. Exigences fonctionnelles — Espace d'administration (CMS)

### 6.1 Authentification

- **EF-70** : Connexion par e-mail et mot de passe avec option "Se souvenir de moi"
- **EF-71** : Réinitialisation de mot de passe par lien e-mail sécurisé
- **EF-72** : Verrouillage après 5 tentatives échouées
- **EF-73** : Déconnexion sécurisée

### 6.2 Tableau de bord

- **EF-80** : Afficher les statistiques rapides : nombre d'actualités, d'offres, d'images, de messages non lus
- **EF-81** : Afficher les derniers éléments créés ou modifiés

### 6.3 Gestion des actualités

- **EF-90** : Créer, modifier, supprimer des articles
- **EF-91** : Éditeur de texte enrichi (gras, italique, listes, liens, titres) avec sanitisation HTML serveur
- **EF-92** : Définir : titre, catégorie, extrait, corps, image de couverture, date de publication (planification)
- **EF-93** : Génération automatique du slug depuis le titre (unicité garantie)
- **EF-94** : Publication immédiate ou différée (planification par date/heure)
- **EF-95** : Dépublication possible (effacement de la date de publication)

### 6.4 Gestion des offres d'emploi

- **EF-100** : Créer, modifier, supprimer des offres
- **EF-101** : Définir : titre, résumé, missions (liste de points), profil (liste de points), compétences (tags)
- **EF-102** : Publication avec planification (même logique que les actualités)
- **EF-103** : Génération automatique du slug

### 6.5 Gestion de la galerie

- **EF-110** : Ajouter, modifier, supprimer des photos
- **EF-111** : Définir : titre, légende, image, position d'affichage (ordre)
- **EF-112** : Réordonnancement des images par modification de la position

### 6.6 Médiathèque

- **EF-120** : Téléverser des fichiers images et documents
- **EF-121** : Consulter la liste des médias uploadés avec : nom, type, taille, date, auteur
- **EF-122** : Supprimer un média (avec suppression physique du fichier)
- **EF-123** : Ajouter un texte alternatif (alt text) sur chaque média

### 6.7 Gestion des blocs de contenu

- **EF-130** : Créer, modifier, supprimer des blocs (icône + titre + description)
- **EF-131** : Regrouper les blocs par contexte (groupe : métiers, HSE, équipements, etc.)
- **EF-132** : Sélectionner une icône depuis un catalogue visuel intégré (Hugeicons)
- **EF-133** : Définir une position d'affichage

### 6.8 Gestion des réalisations

- **EF-140** : Créer, modifier, supprimer des projets/réalisations
- **EF-141** : Définir : titre, catégorie, description, image, faits marquants (liste), tags, position
- **EF-142** : Publication avec planification

### 6.9 Gestion de la chronologie (Jalons)

- **EF-150** : Créer, modifier, supprimer des jalons de l'historique de l'entreprise
- **EF-151** : Définir : libellé d'année, catégorie, titre, description, position

### 6.10 Gestion des pages

- **EF-160** : Éditer le contenu textuel des 5 pages publiques (Accueil, À propos, Métiers, HSE, Équipements)
- **EF-161** : Formulaire d'édition généré dynamiquement selon le schéma de chaque page
- **EF-162** : Contenu organisé en sections et champs nommés (textes courts et longs)

### 6.11 Gestion des messages

- **EF-170** : Consulter les soumissions du formulaire de contact
- **EF-171** : Marquer un message comme lu/non lu
- **EF-172** : Supprimer un message
- **EF-173** : Télécharger le CV joint à un message

### 6.12 Gestion des utilisateurs

- **EF-180** : Créer, modifier, supprimer des comptes utilisateurs (admin uniquement)
- **EF-181** : Attribuer un rôle à chaque utilisateur : Administrateur ou Éditeur
- **EF-182** : Réinitialiser le mot de passe d'un utilisateur

### 6.13 Paramètres du site

- **EF-190** : Modifier les informations de contact (adresse, téléphone, e-mail)
- **EF-191** : Modifier les chiffres clés (année de fondation, nombre de rigs, incidents)

---

## 7. Exigences non-fonctionnelles

### 7.1 Performance

- **ENF-01** : Temps de chargement de la page d'accueil inférieur à 3 secondes sur connexion standard
- **ENF-02** : Images statiques pré-optimisées au format WebP avec fallback JPG
- **ENF-03** : Assets CSS/JS minifiés et versionnés (cache-busting automatique)
- **ENF-04** : Pagination pour limiter les requêtes aux listes longues

### 7.2 Sécurité

- **ENF-10** : Mots de passe hachés avec bcrypt (facteur de coût minimum 12)
- **ENF-11** : Protection CSRF sur tous les formulaires
- **ENF-12** : Sanitisation HTML côté serveur avant stockage (liste blanche de balises autorisées)
- **ENF-13** : En-têtes HTTP de sécurité : X-Content-Type-Options, X-Frame-Options, HSTS, Referrer-Policy
- **ENF-14** : Limitation du taux de soumission du formulaire de contact
- **ENF-15** : URL du panneau d'administration configurable (non exposée publiquement par défaut)
- **ENF-16** : Autorisation granulaire par rôle et permission (Spatie Laravel Permission)

### 7.3 Disponibilité et fiabilité

- **ENF-20** : Mode maintenance activable sans intervention sur le code
- **ENF-21** : Page 503 personnalisée en mode maintenance
- **ENF-22** : Sauvegardes automatiques quotidiennes de la base de données et des fichiers uploadés
- **ENF-23** : Rétention des sauvegardes : 7 jours quotidiens, 4 semaines hebdomadaires, 6 mois mensuels

### 7.4 SEO et accessibilité

- **ENF-30** : URLs propres et sémantiques (slugs descriptifs, pas d'ID numériques)
- **ENF-31** : Balises meta title et description sur toutes les pages
- **ENF-32** : Attributs `alt` obligatoires sur toutes les images
- **ENF-33** : Structure de titres hiérarchique (H1 unique par page, H2/H3 en cascade)
- **ENF-34** : Sitemap XML mis à jour dynamiquement lors de chaque publication

### 7.5 Compatibilité et responsive

- **ENF-40** : Affichage optimal sur mobile (320px+), tablette et desktop
- **ENF-41** : Compatibilité avec les navigateurs modernes (Chrome, Firefox, Safari, Edge — 2 dernières versions)

### 7.6 Maintenabilité

- **ENF-50** : Code source organisé selon les conventions Laravel
- **ENF-51** : Suite de tests automatisés couvrant les fonctionnalités principales (Pest)
- **ENF-52** : Documentation de déploiement incluse dans le dépôt
- **ENF-53** : Formatage du code normalisé (Laravel Pint)

---

## 8. Architecture cible

### 8.1 Stack technique

| Couche | Technologie | Version |
|--------|-------------|---------|
| Framework PHP | Laravel | 13.x |
| Langage serveur | PHP | 8.5+ |
| Base de données | SQLite (défaut) / MySQL / MariaDB / PostgreSQL | — |
| Frontend CSS | Tailwind CSS | 4.x |
| Frontend JS | Alpine.js | 3.x |
| Bundler | Vite | 8.x |
| Éditeur riche | Quill | 2.x |
| Tests | Pest | 4.x |
| Rôles & permissions | Spatie Laravel Permission | 6.x |
| Sauvegardes | Spatie Laravel Backup | 10.x |
| Stockage cloud (opt.) | AWS S3 via Flysystem | 3.x |

### 8.2 Environnements

| Environnement | Usage |
|---------------|-------|
| Local | Développement et tests (`composer run dev`) |
| Staging | Validation avant mise en production |
| Production | Site accessible au public |

### 8.3 Options d'hébergement cibles

| Type | Description |
|------|-------------|
| Hébergement mutualisé | Déploiement manuel via FTP/SFTP, compatible cPanel/Plesk |
| VPS / Serveur dédié | Déploiement automatisé via `deploy/provision.sh` (Nginx, PHP, HTTPS Let's Encrypt) |

---

## 9. Contraintes et hypothèses

### 9.1 Contraintes techniques

- L'application doit fonctionner avec PHP 8.2 minimum (recommandé : 8.5)
- La base de données SQLite est utilisée par défaut pour simplifier le déploiement en production
- Les sauvegardes S3 nécessitent un compte AWS et des clés d'accès valides

### 9.2 Contraintes organisationnelles

- Les utilisateurs du CMS n'ont pas de compétences techniques : l'interface doit être intuitive
- Les contenus initiaux (textes, images de marque) sont fournis par le commanditaire
- L'adresse e-mail administrateur doit être configurée pour recevoir les notifications de contact

### 9.3 Hypothèses

- Le nom de domaine et l'hébergement sont à la charge du commanditaire
- Un serveur SMTP ou service d'envoi d'e-mails est disponible en production
- Les images téléversées dans le CMS ne dépassent pas 10 Mo par fichier

---

## 10. Livrables attendus

| # | Livrable | Description |
|---|----------|-------------|
| L1 | Code source | Dépôt Git complet avec historique |
| L2 | Site web déployé | Application fonctionnelle en production |
| L3 | Cahier des charges | Ce document |
| L4 | Documentation technique | Architecture, installation, configuration |
| L5 | Manuel d'utilisation CMS | Guide utilisateur pour les administrateurs |
| L6 | Manuel de procédures de sauvegarde | Procédures manuelles et automatiques |
| L7 | Recette / Plan de tests | Grille de tests d'acceptation |

---

*Document rédigé par l'équipe de développement — SFP Website v1.0 — Septembre 2025*
