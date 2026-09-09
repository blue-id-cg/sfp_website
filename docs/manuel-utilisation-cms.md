# Manuel d'Utilisation du CMS
## Système de Gestion de Contenu — Site Web SFP
### Société de Forages Pétroliers

---

**Référence :** SFP-CMS-MAN-2025-001  
**Version :** 1.0  
**Date :** Septembre 2025  
**Public cible :** Administrateurs et éditeurs du site SFP  

---

## Table des matières

1. [Introduction](#1-introduction)
2. [Accès à l'interface d'administration](#2-accès-à-linterface-dadministration)
3. [Tableau de bord](#3-tableau-de-bord)
4. [Gestion des actualités](#4-gestion-des-actualités)
5. [Gestion des offres d'emploi](#5-gestion-des-offres-demploi)
6. [Gestion de la galerie](#6-gestion-de-la-galerie)
7. [Médiathèque](#7-médiathèque)
8. [Blocs de contenu](#8-blocs-de-contenu)
9. [Réalisations](#9-réalisations)
10. [Chronologie (Jalons)](#10-chronologie-jalons)
11. [Pages du site](#11-pages-du-site)
12. [Messages reçus](#12-messages-reçus)
13. [Gestion des utilisateurs](#13-gestion-des-utilisateurs)
14. [Paramètres du site](#14-paramètres-du-site)
15. [Rôles et permissions](#15-rôles-et-permissions)
16. [Questions fréquentes](#16-questions-fréquentes)

---

## 1. Introduction

### 1.1 Présentation du CMS

Le CMS (Système de Gestion de Contenu) du site SFP permet aux membres de l'équipe communication de mettre à jour le site web sans aucune compétence technique en informatique. Toutes les opérations — créer une actualité, publier une offre d'emploi, ajouter une photo à la galerie — se font via une interface graphique simple, accessible depuis n'importe quel navigateur web.

### 1.2 Ce que vous pouvez faire avec le CMS

| Module | Actions disponibles |
|--------|---------------------|
| Actualités | Écrire, publier, planifier, modifier, supprimer des articles |
| Offres d'emploi | Créer, publier et gérer les offres |
| Galerie photos | Ajouter, réorganiser et supprimer des photos |
| Médiathèque | Téléverser et gérer tous les fichiers du site |
| Blocs de contenu | Modifier les cartes texte+icône des pages métiers |
| Réalisations | Gérer les projets mis en avant sur le site |
| Chronologie | Mettre à jour les jalons historiques de l'entreprise |
| Pages | Modifier les textes des pages principales |
| Messages | Consulter les messages des visiteurs et leurs CV |
| Utilisateurs | Gérer les comptes des membres de l'équipe (admin uniquement) |
| Paramètres | Mettre à jour les coordonnées et chiffres clés |

### 1.3 Rôles disponibles

| Rôle | Description |
|------|-------------|
| **Administrateur** | Accès complet à toutes les fonctionnalités, y compris la gestion des utilisateurs et des paramètres |
| **Éditeur** | Peut créer et gérer le contenu (actualités, offres, galerie, pages, etc.) mais ne peut pas gérer les utilisateurs ni les paramètres |

---

## 2. Accès à l'interface d'administration

### 2.1 URL de connexion

L'interface d'administration est accessible à l'adresse suivante :

```
https://[domaine-du-site]/admin
```

> Remplacez `[domaine-du-site]` par l'URL réelle de votre site. L'administrateur système vous communiquera l'adresse exacte.

### 2.2 Se connecter

1. Ouvrez votre navigateur web (Chrome, Firefox, Edge ou Safari recommandés)
2. Accédez à l'URL de l'administration
3. Saisissez votre **adresse e-mail** et votre **mot de passe**
4. Cochez "Se souvenir de moi" si vous souhaitez rester connecté entre les sessions
5. Cliquez sur **"Se connecter"**

![Écran de connexion]

> **Sécurité :** Après 5 tentatives de connexion échouées consécutives, votre accès sera temporairement bloqué. Contactez l'administrateur si cela se produit.

### 2.3 Mot de passe oublié

1. Sur la page de connexion, cliquez sur **"Mot de passe oublié ?"**
2. Saisissez votre adresse e-mail
3. Cliquez sur **"Envoyer le lien de réinitialisation"**
4. Consultez votre boîte e-mail et cliquez sur le lien reçu
5. Définissez votre nouveau mot de passe (minimum 8 caractères)

### 2.4 Se déconnecter

Cliquez sur votre nom en haut à droite de l'interface, puis sur **"Déconnexion"**.

> **Bonne pratique :** Déconnectez-vous toujours lorsque vous quittez un poste partagé ou que vous terminez votre session de travail.

---

## 3. Tableau de bord

Après connexion, vous accédez au **tableau de bord** qui présente un résumé de l'activité du site :

### 3.1 Indicateurs rapides

En haut de l'écran, des tuiles de couleur affichent :

- **Actualités publiées** : nombre total d'articles visibles sur le site
- **Offres d'emploi actives** : nombre d'offres en ligne
- **Photos en galerie** : nombre de photos publiées
- **Messages non lus** : nombre de messages du formulaire de contact en attente de lecture

### 3.2 Derniers éléments

Le tableau de bord affiche également les derniers éléments ajoutés ou modifiés dans chaque module, avec des liens rapides pour y accéder directement.

---

## 4. Gestion des actualités

### 4.1 Accéder au module

Dans le menu de navigation à gauche, cliquez sur **"Actualités"**.

### 4.2 Liste des actualités

La page affiche toutes les actualités créées avec, pour chacune :
- Le titre de l'article
- La catégorie
- La date de publication (ou "Brouillon" si non publiée)
- Les boutons d'action : Modifier, Supprimer

### 4.3 Créer une nouvelle actualité

1. Cliquez sur le bouton **"+ Nouvelle actualité"**
2. Remplissez les champs du formulaire :

| Champ | Description | Obligatoire |
|-------|-------------|-------------|
| **Titre** | Titre de l'article (génère automatiquement l'URL) | Oui |
| **Catégorie** | Catégorie thématique de l'article | Oui |
| **Extrait** | Résumé court (affiché sur la liste des actualités) | Oui |
| **Image de couverture** | Photo illustrant l'article | Non |
| **Corps de l'article** | Contenu complet avec mise en forme | Oui |
| **Date de publication** | Date à laquelle l'article sera visible sur le site | Non |

3. Cliquez sur **"Enregistrer"** ou **"Publier"**

### 4.4 L'éditeur de texte enrichi

Le corps de l'article utilise un éditeur visuel (éditeur riche). Les boutons de la barre d'outils permettent :

| Bouton | Action |
|--------|--------|
| **G** (Gras) | Met le texte sélectionné en gras |
| *I* (Italique) | Met le texte sélectionné en italique |
| Liste à puces | Crée une liste non ordonnée |
| Liste numérotée | Crée une liste ordonnée |
| Lien | Insère un lien hypertexte |
| H1/H2/H3 | Insère un titre de niveau 1, 2 ou 3 |
| Citation | Formate le texte en citation |

> **Important :** Seules les mises en forme listées ci-dessus sont conservées lors de la publication. Les couleurs, polices personnalisées et tableaux HTML ne sont pas supportés pour des raisons de sécurité et de cohérence visuelle.

### 4.5 Publication et planification

- **Publication immédiate :** Laissez le champ "Date de publication" vide et cliquez sur "Enregistrer". L'article sera visible immédiatement.
- **Publication planifiée :** Saisissez une date et heure future dans "Date de publication". L'article apparaîtra automatiquement sur le site à la date indiquée.
- **Brouillon :** Si vous souhaitez enregistrer sans publier, effacez la date de publication avant de sauvegarder.

### 4.6 Modifier une actualité

1. Dans la liste des actualités, cliquez sur le bouton **"Modifier"** de l'article souhaité
2. Effectuez vos modifications dans le formulaire
3. Cliquez sur **"Enregistrer"**

### 4.7 Supprimer une actualité

1. Dans la liste des actualités, cliquez sur le bouton **"Supprimer"**
2. Confirmez la suppression dans la boîte de dialogue

> **Attention :** La suppression est définitive et ne peut pas être annulée.

---

## 5. Gestion des offres d'emploi

### 5.1 Accéder au module

Dans le menu de navigation, cliquez sur **"Offres d'emploi"**.

### 5.2 Créer une offre d'emploi

1. Cliquez sur **"+ Nouvelle offre"**
2. Remplissez les champs :

| Champ | Description | Obligatoire |
|-------|-------------|-------------|
| **Titre du poste** | Intitulé de l'offre | Oui |
| **Résumé** | Courte description du poste | Non |
| **Missions** | Liste des missions du poste (une par ligne) | Non |
| **Profil recherché** | Liste des compétences et qualifications requises | Non |
| **Compétences / Tags** | Mots-clés (ex. : "forage", "HSE", "pétrole") | Non |
| **Date de publication** | Date de mise en ligne | Non |

### 5.3 Saisir les missions et le profil

Les champs **Missions** et **Profil recherché** acceptent des listes de points. Saisissez chaque élément sur une ligne distincte. Ils seront affichés sous forme de liste à puces sur le site public.

**Exemple pour "Missions" :**
```
Réaliser les opérations de forage selon les programmes définis
Assurer la maintenance préventive des équipements de forage
Rédiger les rapports d'activité journaliers
Respecter les procédures HSE en vigueur
```

### 5.4 Saisir les compétences (tags)

Dans le champ "Compétences", tapez un mot-clé puis appuyez sur **Entrée** ou **virgule** pour l'ajouter. Vous pouvez supprimer un tag en cliquant sur le "×" à côté de lui.

---

## 6. Gestion de la galerie

### 6.1 Accéder au module

Dans le menu de navigation, cliquez sur **"Galerie"**.

### 6.2 Ajouter une photo

1. Cliquez sur **"+ Ajouter une photo"**
2. Remplissez les champs :

| Champ | Description |
|-------|-------------|
| **Titre** | Nom descriptif de la photo |
| **Légende** | Texte affiché sous la photo (optionnel) |
| **Image** | Fichier image à téléverser (JPEG, PNG, WebP) |
| **Position** | Ordre d'affichage (nombre entier ; 1 = premier) |

3. Cliquez sur **"Enregistrer"**

### 6.3 Réorganiser les photos

Pour modifier l'ordre d'affichage des photos dans la galerie, modifiez le champ **"Position"** de chaque photo. Les photos sont affichées par ordre croissant de position (1, 2, 3...).

### 6.4 Supprimer une photo

1. Cliquez sur **"Supprimer"** en face de la photo concernée
2. Confirmez la suppression

---

## 7. Médiathèque

La médiathèque centralise tous les fichiers (images, documents) téléversés dans le CMS.

### 7.1 Accéder au module

Dans le menu de navigation, cliquez sur **"Médiathèque"**.

### 7.2 Téléverser un fichier

1. Cliquez sur **"+ Téléverser"**
2. Sélectionnez le(s) fichier(s) sur votre ordinateur
3. Ajoutez un texte alternatif (alt text) si le fichier est une image — ce texte est indispensable pour l'accessibilité et le référencement
4. Cliquez sur **"Téléverser"**

**Types de fichiers acceptés :** Images (JPEG, PNG, WebP, GIF) et documents PDF.

### 7.3 Consulter les fichiers

La liste affiche pour chaque fichier :
- Le nom original du fichier
- Le type (image/pdf)
- La taille
- La date de téléversement
- L'utilisateur qui a uploadé le fichier

### 7.4 Supprimer un fichier

> **Important :** Vérifiez qu'un fichier n'est pas utilisé sur le site avant de le supprimer. La suppression retire définitivement le fichier du serveur.

1. Cliquez sur **"Supprimer"** en face du fichier
2. Confirmez la suppression

---

## 8. Blocs de contenu

Les blocs de contenu sont des cartes réutilisables (icône + titre + description) utilisées sur les pages Métiers, HSE et Équipements pour présenter les activités ou indicateurs de manière visuelle.

### 8.1 Accéder au module

Dans le menu de navigation, cliquez sur **"Blocs de contenu"**.

### 8.2 Comprendre les groupes

Chaque bloc appartient à un **groupe** qui détermine sur quelle page et dans quelle section il apparaît.

| Groupe | Page | Usage |
|--------|------|-------|
| `trades` | Nos Métiers | Présentation des activités (forage, complétion, workover) |
| `hse_metrics` | HSE | Indicateurs de performance HSE |
| `equipment_specs` | Équipements | Caractéristiques des équipements |

### 8.3 Créer un bloc

1. Cliquez sur **"+ Nouveau bloc"**
2. Remplissez les champs :

| Champ | Description |
|-------|-------------|
| **Groupe** | Contexte d'utilisation (voir tableau ci-dessus) |
| **Icône** | Sélectionnez une icône dans le catalogue visuel |
| **Titre** | Titre court du bloc |
| **Description** | Texte descriptif |
| **Position** | Ordre d'affichage dans le groupe |

3. Cliquez sur **"Enregistrer"**

### 8.4 Choisir une icône

Le catalogue d'icônes propose une sélection d'icônes de la bibliothèque Hugeicons. Cliquez sur l'icône souhaitée pour la sélectionner.

---

## 9. Réalisations

Ce module gère les projets et chantiers mis en avant sur le site.

### 9.1 Créer une réalisation

1. Accédez à **"Réalisations"** dans le menu
2. Cliquez sur **"+ Nouvelle réalisation"**
3. Remplissez les champs :

| Champ | Description |
|-------|-------------|
| **Titre** | Nom du projet |
| **Catégorie** | Type de projet (forage, workover, etc.) |
| **Description** | Présentation du projet |
| **Image** | Photo ou visuel du projet |
| **Faits marquants** | Points clés (ex. : "Profondeur : 3 500 m") |
| **Tags** | Mots-clés associés |
| **Position** | Ordre d'affichage |
| **Date de publication** | Date de mise en ligne |

---

## 10. Chronologie (Jalons)

Ce module gère la frise chronologique de l'historique de l'entreprise.

### 10.1 Créer un jalon

1. Accédez à **"Chronologie"** dans le menu
2. Cliquez sur **"+ Nouveau jalon"**
3. Remplissez les champs :

| Champ | Description | Exemple |
|-------|-------------|---------|
| **Année** | Libellé de la période | "1985", "2001-2005" |
| **Catégorie** | Type d'événement | "Création", "Expansion", "Certification" |
| **Titre** | Intitulé de l'événement | "Création de la SFP" |
| **Description** | Détails de l'événement | Texte libre |
| **Position** | Ordre d'affichage | 1, 2, 3... |

---

## 11. Pages du site

Ce module permet de modifier les textes des 5 pages principales du site sans toucher au code.

### 11.1 Pages éditables

| Page | Sections disponibles |
|------|---------------------|
| **Accueil** | Hero, Présentation, Actualités, Galerie, Chiffres clés, Réalisations |
| **À propos** | Présentation, Histoire, Valeurs, Gouvernance, Chiffres, Vision |
| **Nos métiers** | Introduction, Forage, Complétion, Workover |
| **HSE** | Politique HSE, Certifications, Indicateurs |
| **Équipements** | Présentation, Parc de rigs, Outillage spécialisé |

### 11.2 Modifier une page

1. Accédez à **"Pages"** dans le menu
2. Cliquez sur **"Modifier"** en face de la page souhaitée
3. Chaque section affiche ses champs de texte (titre, sous-titre, paragraphes)
4. Modifiez le contenu souhaité
5. Cliquez sur **"Enregistrer"**

> **Note :** Les modifications sont immédiatement visibles sur le site public dès l'enregistrement.

---

## 12. Messages reçus

Ce module centralise tous les messages envoyés via le formulaire de contact du site.

### 12.1 Consulter les messages

1. Accédez à **"Messages"** dans le menu
2. La liste affiche tous les messages avec : expéditeur, objet, date, statut (lu/non lu)
3. Les **messages en gras** sont non lus
4. Cliquez sur un message pour le lire dans son intégralité

### 12.2 Télécharger un CV joint

Si un candidat a joint son CV au message, un bouton **"Télécharger le CV"** apparaît dans le détail du message. Cliquez dessus pour télécharger le fichier.

### 12.3 Supprimer un message

1. Dans la liste ou le détail d'un message, cliquez sur **"Supprimer"**
2. Confirmez la suppression

> **Conseil :** Répondez directement aux messages par e-mail en utilisant l'adresse de l'expéditeur affichée dans le message.

---

## 13. Gestion des utilisateurs

> **Accès réservé aux Administrateurs.**

### 13.1 Voir la liste des utilisateurs

Accédez à **"Utilisateurs"** dans le menu. La liste affiche tous les comptes avec leur nom, e-mail et rôle.

### 13.2 Créer un compte utilisateur

1. Cliquez sur **"+ Nouvel utilisateur"**
2. Remplissez les champs :

| Champ | Description |
|-------|-------------|
| **Nom** | Prénom et nom de l'utilisateur |
| **E-mail** | Adresse e-mail (servira de login) |
| **Mot de passe** | Mot de passe initial |
| **Rôle** | Administrateur ou Éditeur |

3. Cliquez sur **"Enregistrer"**
4. Communiquez les identifiants à l'utilisateur et demandez-lui de changer son mot de passe dès sa première connexion

### 13.3 Modifier un utilisateur

1. Cliquez sur **"Modifier"** en face de l'utilisateur
2. Vous pouvez modifier le nom, l'e-mail, le mot de passe ou le rôle
3. Cliquez sur **"Enregistrer"**

### 13.4 Supprimer un utilisateur

1. Cliquez sur **"Supprimer"** en face de l'utilisateur
2. Confirmez la suppression

> **Attention :** Ne supprimez pas votre propre compte. Si vous devez le faire, demandez à un autre administrateur.

---

## 14. Paramètres du site

> **Accès réservé aux Administrateurs.**

### 14.1 Informations de contact

Accédez à **"Paramètres"** dans le menu pour mettre à jour :

| Champ | Description |
|-------|-------------|
| **Adresse** | Adresse postale de la SFP |
| **Téléphone** | Numéro de téléphone principal |
| **E-mail** | Adresse e-mail de contact affichée sur le site |

### 14.2 Chiffres clés

Ces chiffres apparaissent sur la page d'accueil et la page "À propos" :

| Champ | Description | Exemple |
|-------|-------------|---------|
| **Année de fondation** | Année de création de la SFP | 1985 |
| **Nombre de rigs** | Parc de foreurs opérationnels | 12 |
| **Incidents HSE** | Nombre d'incidents (LTI) sur la période | 0 |

---

## 15. Rôles et permissions

### 15.1 Tableau des permissions

| Action | Administrateur | Éditeur |
|--------|:--------------:|:-------:|
| Gérer les actualités | ✅ | ✅ |
| Gérer les offres d'emploi | ✅ | ✅ |
| Gérer la galerie | ✅ | ✅ |
| Gérer la médiathèque | ✅ | ✅ |
| Gérer les blocs de contenu | ✅ | ✅ |
| Gérer les réalisations | ✅ | ✅ |
| Gérer la chronologie | ✅ | ✅ |
| Modifier les pages | ✅ | ✅ |
| Consulter les messages | ✅ | ✅ |
| Supprimer des messages | ✅ | ✅ |
| Gérer les utilisateurs | ✅ | ❌ |
| Modifier les rôles | ✅ | ❌ |
| Modifier les paramètres | ✅ | ❌ |

---

## 16. Questions fréquentes

**Q : Mon article est enregistré mais n'apparaît pas sur le site. Pourquoi ?**  
R : Vérifiez que le champ "Date de publication" est rempli et que la date est passée. Si la date est dans le futur, l'article ne sera visible qu'à partir de cette date.

---

**Q : Je veux modifier l'URL d'un article (le slug). Comment faire ?**  
R : Le slug est généré automatiquement à partir du titre lors de la création. Il n'est pas modifiable après création pour éviter les liens brisés. Si l'URL est problématique, il est préférable de supprimer et recréer l'article.

---

**Q : J'ai téléversé une image mais elle ne s'affiche pas correctement. Que faire ?**  
R : Vérifiez que le fichier est bien au format JPEG, PNG ou WebP. Si le problème persiste, contactez l'administrateur système — il peut être nécessaire de lancer la commande `php artisan storage:link` sur le serveur.

---

**Q : Je ne reçois pas les notifications e-mail des nouveaux messages. Que faire ?**  
R : Vérifiez votre dossier de courrier indésirable (spam). Si les e-mails n'arrivent toujours pas, l'administrateur système devra vérifier la configuration SMTP dans le fichier `.env` du serveur.

---

**Q : Peut-on avoir plusieurs images pour une même actualité ?**  
R : Actuellement, chaque actualité supporte une seule image de couverture. Des images supplémentaires peuvent être téléversées dans la médiathèque pour un usage futur.

---

**Q : Comment savoir si une sauvegarde a bien été effectuée ?**  
R : Des notifications e-mail sont envoyées à l'administrateur en cas d'échec. L'absence de notification e-mail indique que la sauvegarde s'est déroulée correctement. Pour une vérification active, consultez le Manuel de Procédure de Sauvegarde.

---

**Q : L'interface est lente ou ne se charge pas. Que faire ?**  
R : Vérifiez votre connexion internet. Si le problème persiste sur plusieurs postes, le site est peut-être en maintenance. Contactez l'administrateur système.

---

*Manuel d'utilisation CMS — SFP Website v1.0 — Septembre 2025*
