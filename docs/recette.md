# Plan de Recette et Grille de Tests d'Acceptation
## Site Web SFP — Validation Fonctionnelle
### Société de Forages Pétroliers

---

**Référence :** SFP-REC-2025-001  
**Version :** 1.0  
**Date :** Septembre 2025  
**Statut :** À compléter lors de la recette  

---

## Table des matières

1. [Objet et portée](#1-objet-et-portée)
2. [Environnement de recette](#2-environnement-de-recette)
3. [Conventions de notation](#3-conventions-de-notation)
4. [Recette 01 — Site public : Navigation](#4-recette-01--site-public--navigation)
5. [Recette 02 — Site public : Actualités](#5-recette-02--site-public--actualités)
6. [Recette 03 — Site public : Carrières](#6-recette-03--site-public--carrières)
7. [Recette 04 — Site public : Galerie](#7-recette-04--site-public--galerie)
8. [Recette 05 — Site public : Formulaire de contact](#8-recette-05--site-public--formulaire-de-contact)
9. [Recette 06 — Authentification](#9-recette-06--authentification)
10. [Recette 07 — CMS : Actualités](#10-recette-07--cms--actualités)
11. [Recette 08 — CMS : Offres d'emploi](#11-recette-08--cms--offres-demploi)
12. [Recette 09 — CMS : Galerie](#12-recette-09--cms--galerie)
13. [Recette 10 — CMS : Médiathèque](#13-recette-10--cms--médiathèque)
14. [Recette 11 — CMS : Pages du site](#14-recette-11--cms--pages-du-site)
15. [Recette 12 — CMS : Messages](#15-recette-12--cms--messages)
16. [Recette 13 — CMS : Utilisateurs et rôles](#16-recette-13--cms--utilisateurs-et-rôles)
17. [Recette 14 — CMS : Paramètres](#17-recette-14--cms--paramètres)
18. [Recette 15 — Sauvegarde](#18-recette-15--sauvegarde)
19. [Recette 16 — Sécurité](#19-recette-16--sécurité)
20. [Recette 17 — SEO et performance](#20-recette-17--seo-et-performance)
21. [Recette 18 — Responsive design](#21-recette-18--responsive-design)
22. [Bilan de recette](#22-bilan-de-recette)

---

## 1. Objet et portée

Ce document définit le plan de recette du site web SFP. Il liste l'ensemble des cas de tests à exécuter pour valider que l'application respecte les exigences définies dans le cahier des charges.

La recette doit être réalisée par le commanditaire (ou son représentant) sur l'environnement de production ou de pré-production, avec des données réelles ou des données de test représentatives.

---

## 2. Environnement de recette

| Élément | Valeur |
|---------|--------|
| URL site public | https://[domaine] |
| URL administration | https://[domaine]/admin |
| Compte testeur (admin) | [à compléter] |
| Compte testeur (éditeur) | [à compléter] |
| Navigateur de test principal | Google Chrome (dernière version) |
| Navigateurs secondaires | Firefox, Safari, Edge |
| Date de début de recette | [à compléter] |
| Date de fin de recette | [à compléter] |
| Responsable de recette | [à compléter] |

---

## 3. Conventions de notation

### Résultat des tests

| Code | Signification | Action |
|------|---------------|--------|
| **OK** | Test réussi — comportement conforme | Aucune |
| **KO** | Test échoué — comportement non conforme | Ouvrir un ticket d'anomalie |
| **NA** | Non applicable dans le contexte actuel | Justifier |
| **EN COURS** | Test en cours d'exécution | — |

### Sévérité des anomalies

| Niveau | Définition | Exemple |
|--------|------------|---------|
| **BLOQUANT** | Empêche l'utilisation de la fonctionnalité | Page blanche, erreur 500 |
| **MAJEUR** | Fonctionnalité partiellement inopérante | Formulaire ne s'envoie pas |
| **MINEUR** | Imperfection sans impact fonctionnel | Texte mal aligné |
| **COSMÉTIQUE** | Écart visuel non fonctionnel | Couleur légèrement décalée |

---

## 4. Recette 01 — Site public : Navigation

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 01.01 | Page d'accueil | Accéder à l'URL racine du site | La page d'accueil s'affiche avec le logo, le menu, le hero et toutes les sections | | |
| 01.02 | Page À propos | Cliquer sur "À propos" dans le menu | La page s'affiche avec le contenu de la SFP | | |
| 01.03 | Page Nos Métiers | Cliquer sur "Nos Métiers" dans le menu | La page s'affiche avec les activités (forage, complétion, workover) | | |
| 01.04 | Page HSE | Cliquer sur "HSE" dans le menu | La page s'affiche avec la politique sécurité et les indicateurs | | |
| 01.05 | Page Équipements | Cliquer sur "Équipements" dans le menu | La page s'affiche avec le parc matériel | | |
| 01.06 | Page Actualités | Cliquer sur "Actualités" dans le menu | La liste des actualités publiées s'affiche | | |
| 01.07 | Page Carrières | Cliquer sur "Carrières" dans le menu | La liste des offres d'emploi publiées s'affiche | | |
| 01.08 | Page Galerie | Cliquer sur "Galerie" dans le menu | La galerie photos s'affiche | | |
| 01.09 | Formulaire Contact | Cliquer sur "Contact" ou le bouton dédié | Le formulaire de contact s'affiche | | |
| 01.10 | Mentions légales | Cliquer sur "Mentions légales" dans le pied de page | La page légale s'affiche | | |
| 01.11 | Politique confidentialité | Cliquer sur "Politique de confidentialité" dans le pied de page | La page s'affiche | | |
| 01.12 | Navigation mobile | Réduire la fenêtre à 375px de large, ouvrir le menu burger | Le menu s'affiche correctement en version mobile | | |
| 01.13 | Logo cliquable | Cliquer sur le logo SFP | Retour sur la page d'accueil | | |
| 01.14 | Pied de page | Faire défiler jusqu'en bas de la page d'accueil | Les informations de contact (adresse, téléphone, e-mail) s'affichent dans le footer | | |
| 01.15 | 404 personnalisée | Accéder à une URL inexistante (ex. `/inexistant`) | Une page 404 s'affiche (pas une erreur serveur brute) | | |

---

## 5. Recette 02 — Site public : Actualités

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 02.01 | Liste des actualités | Accéder à `/actualites` | Les articles publiés s'affichent par date décroissante, 9 par page | | |
| 02.02 | Pagination | S'il y a plus de 9 actualités, cliquer sur "Page 2" | La page 2 s'affiche avec les articles suivants | | |
| 02.03 | Détail d'un article | Cliquer sur le titre d'une actualité | La page de l'article s'ouvre avec le corps complet, l'image et la date | | |
| 02.04 | URL avec slug | Vérifier l'URL d'un article | L'URL est de la forme `/actualites/titre-de-larticle` (pas d'ID numérique) | | |
| 02.05 | Article non publié | Accéder directement à l'URL d'un article non publié (brouillon) | Retourne une erreur 404 | | |
| 02.06 | Article planifié futur | Créer un article avec date future, vérifier le site | L'article n'est pas visible sur le site public | | |
| 02.07 | Image de couverture | Consulter un article avec image | L'image s'affiche correctement sur la liste et le détail | | |
| 02.08 | Mise en forme HTML | Ouvrir un article avec gras, listes, liens | Le contenu HTML s'affiche correctement avec la mise en forme | | |

---

## 6. Recette 03 — Site public : Carrières

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 03.01 | Liste des offres | Accéder à `/carrieres` | Les offres publiées s'affichent | | |
| 03.02 | Détail d'une offre | Cliquer sur une offre | La page de l'offre s'affiche avec : titre, résumé, missions (liste), profil (liste), compétences (tags) | | |
| 03.03 | URL avec slug | Vérifier l'URL d'une offre | L'URL est de la forme `/carrieres/offres/titre-du-poste` | | |
| 03.04 | Offre non publiée | Accéder directement à une offre non publiée | Retourne une erreur 404 | | |
| 03.05 | Bouton Postuler | Cliquer sur "Postuler" dans une offre | Redirige vers le formulaire de contact avec l'objet pré-rempli | | |

---

## 7. Recette 04 — Site public : Galerie

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 04.01 | Affichage galerie | Accéder à `/galerie` | Les photos s'affichent en grille, paginées | | |
| 04.02 | Ordre des photos | Comparer l'ordre affiché avec les positions définies dans le CMS | Les photos s'affichent dans l'ordre des positions | | |
| 04.03 | Alt text | Inspecter le code HTML d'une image (`<img alt="...">`) | L'attribut alt est rempli pour chaque image | | |
| 04.04 | Pagination galerie | S'il y a plus d'une page, naviguer sur la suivante | La galerie se pagine correctement | | |

---

## 8. Recette 05 — Site public : Formulaire de contact

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 05.01 | Affichage formulaire | Accéder au formulaire de contact | Tous les champs s'affichent : Nom, E-mail, Téléphone, Objet, Message, CV (optionnel) | | |
| 05.02 | Envoi sans CV | Remplir tous les champs sans pièce jointe, soumettre | Message de confirmation affiché, e-mail reçu par l'admin | | |
| 05.03 | Envoi avec CV | Remplir les champs et joindre un fichier PDF, soumettre | Message de confirmation, e-mail reçu avec le CV en pièce jointe | | |
| 05.04 | Validation e-mail invalide | Saisir un e-mail mal formé (ex. "test@"), soumettre | Erreur de validation affichée, formulaire non envoyé | | |
| 05.05 | Champ obligatoire vide | Laisser le champ "Nom" vide, soumettre | Erreur de validation affichée, formulaire non envoyé | | |
| 05.06 | Fichier invalide | Joindre un fichier .exe, soumettre | Erreur de validation affichée, formulaire non envoyé | | |
| 05.07 | Anti-spam (rate limit) | Envoyer 6 messages successifs en moins d'une minute | Le 6ème envoi est refusé avec un message d'erreur | | |
| 05.08 | Message visible en admin | Après envoi, aller dans Admin → Messages | Le message apparaît dans la liste | | |

---

## 9. Recette 06 — Authentification

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 06.01 | Connexion valide | Saisir un e-mail et mot de passe valides, soumettre | Redirection vers le tableau de bord admin | | |
| 06.02 | Connexion invalide | Saisir un mauvais mot de passe, soumettre | Message d'erreur, pas de connexion | | |
| 06.03 | Blocage après 5 tentatives | Essayer 5 fois avec un mauvais mot de passe | Accès bloqué temporairement avec message explicatif | | |
| 06.04 | Réinitialisation mot de passe | Cliquer "Mot de passe oublié", saisir l'e-mail | E-mail de réinitialisation reçu | | |
| 06.05 | Lien de réinitialisation | Cliquer sur le lien reçu, définir un nouveau mot de passe | Nouveau mot de passe accepté, connexion possible | | |
| 06.06 | Accès admin sans authentification | Accéder directement à `/admin/actualites` sans être connecté | Redirection vers la page de connexion | | |
| 06.07 | Déconnexion | Cliquer sur "Déconnexion" | Session terminée, redirection vers la page de connexion | | |
| 06.08 | Se souvenir de moi | Cocher "Se souvenir de moi", fermer et rouvrir le navigateur | L'utilisateur est toujours connecté | | |

---

## 10. Recette 07 — CMS : Actualités

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 07.01 | Liste des actualités en admin | Aller dans Admin → Actualités | La liste de toutes les actualités (publiées et brouillons) s'affiche | | |
| 07.02 | Créer un article | Cliquer "+ Nouvelle actualité", remplir tous les champs, enregistrer | L'article apparaît dans la liste admin | | |
| 07.03 | Article visible sur le site | Créer un article avec date passée, vérifier sur le site public | L'article apparaît dans la liste des actualités publiques | | |
| 07.04 | Brouillon non visible | Créer un article sans date de publication, vérifier sur le site public | L'article n'apparaît pas sur le site public | | |
| 07.05 | Publication planifiée | Créer un article avec une date future | L'article n'est pas visible avant la date, il apparaît à la date prévue | | |
| 07.06 | Slug automatique | Créer un article, observer l'URL générée | Le slug correspond au titre en minuscules, sans accents, avec tirets | | |
| 07.07 | Éditeur riche | Mettre du texte en gras, créer une liste, insérer un lien, enregistrer | La mise en forme est visible à l'enregistrement et sur le site public | | |
| 07.08 | Sanitisation HTML | Coller du HTML avec `<script>` dans l'éditeur, enregistrer, voir la page publique | La balise script est supprimée (non affichée, non exécutée) | | |
| 07.09 | Image de couverture | Créer un article avec une image, voir la liste et le détail | L'image s'affiche sur la liste et la page de l'article | | |
| 07.10 | Modifier un article | Cliquer "Modifier" sur un article, changer le titre, enregistrer | Le changement est visible en admin et sur le site | | |
| 07.11 | Supprimer un article | Cliquer "Supprimer" sur un article, confirmer | L'article disparaît de la liste et n'est plus accessible sur le site | | |
| 07.12 | Permissions éditeur | Se connecter avec un compte éditeur | L'éditeur peut créer/modifier/supprimer des actualités | | |

---

## 11. Recette 08 — CMS : Offres d'emploi

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 08.01 | Créer une offre | Remplir tous les champs (titre, résumé, missions, profil, tags), enregistrer | L'offre apparaît dans la liste admin | | |
| 08.02 | Missions en liste | Saisir 3 missions sur 3 lignes séparées | Sur le site, les missions s'affichent en liste à puces | | |
| 08.03 | Tags | Saisir des tags (ex. "forage", "HSE"), enregistrer | Les tags s'affichent sur la page de l'offre | | |
| 08.04 | Publication | Définir une date de publication, vérifier sur le site | L'offre est visible dans la section Carrières | | |
| 08.05 | Modifier une offre | Modifier le titre d'une offre existante | Le changement est visible | | |
| 08.06 | Supprimer une offre | Supprimer une offre, vérifier sur le site | L'offre n'est plus accessible | | |

---

## 12. Recette 09 — CMS : Galerie

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 09.01 | Ajouter une photo | Remplir titre, légende, téléverser une image, définir position, enregistrer | La photo apparaît dans la liste admin et la galerie publique | | |
| 09.02 | Ordre d'affichage | Définir position=1 sur une photo, position=2 sur une autre | La photo avec position=1 s'affiche en premier | | |
| 09.03 | Modifier une photo | Changer la légende d'une photo | Le changement est visible sur le site | | |
| 09.04 | Supprimer une photo | Supprimer une photo, vérifier la galerie | La photo disparaît de la galerie | | |

---

## 13. Recette 10 — CMS : Médiathèque

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 10.01 | Téléverser une image | Cliquer "+ Téléverser", sélectionner un JPG, remplir l'alt text | Le fichier apparaît dans la liste avec nom, taille, date | | |
| 10.02 | Téléverser un PDF | Téléverser un fichier PDF | Le fichier apparaît dans la liste | | |
| 10.03 | Fichier trop volumineux | Téléverser un fichier > 10 Mo | Erreur de validation affichée | | |
| 10.04 | Supprimer un fichier | Supprimer un fichier de la médiathèque | Le fichier disparaît de la liste et du serveur | | |
| 10.05 | Traçabilité | Vérifier la colonne "Téléversé par" | Le nom de l'utilisateur connecté s'affiche | | |

---

## 14. Recette 11 — CMS : Pages du site

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 11.01 | Modifier la page d'accueil | Admin → Pages → Accueil → Modifier, changer le titre du hero | Le nouveau titre s'affiche sur la page d'accueil publique | | |
| 11.02 | Modifier la page À propos | Modifier un texte de la page "À propos" | Le changement est visible sur le site | | |
| 11.03 | Modifier la page Métiers | Modifier un texte de la page "Nos métiers" | Le changement est visible sur le site | | |
| 11.04 | Modifier la page HSE | Modifier un texte de la page "HSE" | Le changement est visible sur le site | | |
| 11.05 | Modifier la page Équipements | Modifier un texte de la page "Équipements" | Le changement est visible sur le site | | |

---

## 15. Recette 12 — CMS : Messages

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 12.01 | Message non lu | Envoyer un message via le formulaire, aller dans Admin → Messages | Le message apparaît en gras (non lu) avec le compteur mis à jour | | |
| 12.02 | Lire un message | Cliquer sur le message | Le message s'ouvre, il est marqué comme lu (non gras) | | |
| 12.03 | Télécharger un CV | Ouvrir un message avec CV joint, cliquer "Télécharger le CV" | Le fichier PDF se télécharge | | |
| 12.04 | Supprimer un message | Supprimer un message de la liste | Le message disparaît de la liste | | |
| 12.05 | Permissions éditeur | Se connecter comme éditeur, accéder aux messages | L'éditeur peut consulter les messages | | |
| 12.06 | Restriction éditeur | Se connecter comme éditeur, essayer d'accéder à Admin → Utilisateurs | Accès refusé (403) ou redirection | | |

---

## 16. Recette 13 — CMS : Utilisateurs et rôles

> Tests à effectuer avec un compte Administrateur

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 13.01 | Liste des utilisateurs | Admin → Utilisateurs | La liste de tous les comptes s'affiche avec nom, e-mail, rôle | | |
| 13.02 | Créer un éditeur | Créer un compte avec rôle "Éditeur" | Le compte est créé et visible dans la liste | | |
| 13.03 | Connexion éditeur | Se connecter avec le nouveau compte éditeur | Connexion réussie, accès au CMS sans accès à la section Utilisateurs | | |
| 13.04 | Modifier un utilisateur | Changer le rôle d'un utilisateur de Éditeur → Administrateur | Le changement de rôle est immédiatement effectif | | |
| 13.05 | Supprimer un utilisateur | Supprimer un compte éditeur | Le compte disparaît, connexion impossible avec cet identifiant | | |
| 13.06 | Éditeur ne peut pas gérer utilisateurs | Se connecter comme éditeur, accéder à Admin → Utilisateurs | Accès refusé | | |

---

## 17. Recette 14 — CMS : Paramètres

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 14.01 | Modifier l'adresse | Admin → Paramètres, changer l'adresse postale, enregistrer | La nouvelle adresse s'affiche dans le pied de page du site | | |
| 14.02 | Modifier le téléphone | Changer le numéro de téléphone | Le nouveau numéro s'affiche dans le footer et la page Contact | | |
| 14.03 | Modifier les chiffres clés | Changer le nombre de rigs, enregistrer | Le chiffre est mis à jour sur la page d'accueil et "À propos" | | |
| 14.04 | Restriction éditeur | Se connecter comme éditeur, accéder à Admin → Paramètres | Accès refusé | | |

---

## 18. Recette 15 — Sauvegarde

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 15.01 | Sauvegarde manuelle | Se connecter en SSH, lancer `php artisan backup:run` | Commande se termine avec succès, archive créée dans `storage/app/backups/SFP/` | | |
| 15.02 | Vérification archive | `php artisan backup:monitor` | Toutes les destinations sont déclarées "healthy" | | |
| 15.03 | Intégrité archive | `unzip -t [archive.zip]` sur la dernière archive | Aucune erreur, tous les fichiers sont valides | | |
| 15.04 | Nettoyage automatique | `php artisan backup:clean` | Les archives selon la politique de rétention sont conservées/supprimées | | |
| 15.05 | Sauvegarde cron | Vérifier le lendemain qu'une nouvelle archive existe | Archive datée du jour dans le répertoire de sauvegardes | | |

---

## 19. Recette 16 — Sécurité

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 16.01 | En-têtes de sécurité | Ouvrir les DevTools du navigateur → Onglet Réseau → En-têtes de réponse | Présence de : `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy` | | |
| 16.02 | HTTPS | Accéder au site en HTTP | Redirection automatique vers HTTPS | | |
| 16.03 | CSRF | Ouvrir le formulaire de contact, inspecter le code source | Le champ caché `_token` est présent dans le formulaire | | |
| 16.04 | XSS — formulaire contact | Saisir `<script>alert('xss')</script>` dans le champ Message, envoyer | La balise script est encodée ou supprimée, aucune alerte JavaScript ne s'exécute | | |
| 16.05 | XSS — éditeur riche | Saisir `<script>alert('xss')</script>` dans le corps d'un article, enregistrer | Le script est supprimé lors de la sauvegarde, n'apparaît pas sur le site | | |
| 16.06 | Accès direct fichiers | Essayer d'accéder directement à `storage/app/private/[nom-cv]` | Accès refusé (403 ou 404) — les CV ne sont pas accessibles publiquement | | |
| 16.07 | Mode maintenance | `php artisan down`, accéder au site | Page 503 personnalisée s'affiche | | |
| 16.08 | Mode maintenance — admin | `php artisan down`, accéder à `/admin` | L'admin reste accessible (bypass maintenance) | | |
| 16.09 | Robots.txt | Accéder à `/robots.txt` | Le fichier s'affiche avec les directives définies | | |
| 16.10 | Sitemap | Accéder à `/sitemap.xml` | Le sitemap XML valide s'affiche, incluant toutes les pages publiées | | |

---

## 20. Recette 17 — SEO et performance

| # | Cas de test | Étapes | Résultat attendu | Résultat | Obs. |
|---|-------------|--------|------------------|----------|------|
| 17.01 | Balise title | Inspecter le `<title>` de la page d'accueil | Le titre contient "SFP" ou le nom de l'entreprise | | |
| 17.02 | Balise meta description | Inspecter le `<meta name="description">` d'un article | La meta description est présente et non vide | | |
| 17.03 | URL propres | Vérifier les URLs des actualités et offres | URLs en slugs descriptifs (pas d'IDs, pas de paramètres) | | |
| 17.04 | Structure des titres | Inspecter le code HTML de la page d'accueil | Il y a exactement un `<h1>`, et les sous-titres utilisent `<h2>` et `<h3>` | | |
| 17.05 | Images alt | Inspecter toutes les images de la page d'accueil | Chaque `<img>` a un attribut `alt` non vide | | |
| 17.06 | Temps de chargement | Ouvrir DevTools → Onglet Réseau, recharger la page d'accueil | Chargement complet en moins de 5 secondes sur connexion standard | | |
| 17.07 | Assets minifiés | Inspecter les fichiers CSS et JS chargés | Les fichiers sont minifiés (noms avec hash, taille réduite) | | |

---

## 21. Recette 18 — Responsive design

| # | Cas de test | Dispositif | Résultat attendu | Résultat | Obs. |
|---|-------------|------------|------------------|----------|------|
| 18.01 | Mobile 375px | Chrome DevTools - iPhone SE | Page d'accueil lisible, menu burger fonctionnel, images adaptées | | |
| 18.02 | Tablette 768px | Chrome DevTools - iPad | Mise en page adaptée (2 colonnes sur galerie, menu en version tablette) | | |
| 18.03 | Desktop 1280px | Navigateur standard | Mise en page complète, navigation horizontale | | |
| 18.04 | Formulaire contact mobile | Accéder au formulaire sur mobile | Tous les champs sont accessibles et utilisables au doigt | | |
| 18.05 | CMS sur tablette | Accéder à l'admin depuis une tablette | L'interface est utilisable (menu accessible, formulaires fonctionnels) | | |

---

## 22. Bilan de recette

### 22.1 Synthèse des tests

| Module | Nb tests | OK | KO | NA | Taux de réussite |
|--------|----------|----|----|----|-----------------|
| Navigation | 15 | | | | |
| Actualités (public) | 8 | | | | |
| Carrières (public) | 5 | | | | |
| Galerie (public) | 4 | | | | |
| Formulaire contact | 8 | | | | |
| Authentification | 8 | | | | |
| CMS — Actualités | 12 | | | | |
| CMS — Offres | 6 | | | | |
| CMS — Galerie | 4 | | | | |
| CMS — Médiathèque | 5 | | | | |
| CMS — Pages | 5 | | | | |
| CMS — Messages | 6 | | | | |
| CMS — Utilisateurs | 6 | | | | |
| CMS — Paramètres | 4 | | | | |
| Sauvegarde | 5 | | | | |
| Sécurité | 10 | | | | |
| SEO / Performance | 7 | | | | |
| Responsive | 5 | | | | |
| **TOTAL** | **123** | | | | |

### 22.2 Anomalies détectées

| # | Module | Description | Sévérité | Statut | Assigné à |
|---|--------|-------------|----------|--------|-----------|
| | | | | | |

### 22.3 Décision de recette

| Décision | Date | Signataire |
|----------|------|------------|
| ☐ Recette prononcée (sans réserve) | | |
| ☐ Recette prononcée avec réserves (anomalies mineures) | | |
| ☐ Recette rejetée (anomalies bloquantes ou majeures) | | |

**Commentaires :**

_______________________________________________
_______________________________________________

---

*Plan de Recette — SFP Website v1.0 — Septembre 2025*
