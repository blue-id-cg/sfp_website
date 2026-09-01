<?php

/*
|--------------------------------------------------------------------------
| Public page content schema
|--------------------------------------------------------------------------
|
| Defines, per page slug, the fixed set of editable text sections and fields shown in the admin
| (resources/views/admin/pages/edit.blade.php renders this schema — it is not itself editable by
| admins, only the values are). Repeating icon+title+description cards live in ContentBlock
| instead (grouped by a "group" key), and site-wide values (contact info, key figures) live in
| SiteSetting. Field type "textarea" renders a multi-line input; "text" a single-line input.
|
*/

return [

    'schemas' => [

        'home' => [
            'hero' => [
                'label' => 'Accueil — Hero',
                'fields' => [
                    'subhead' => ['label' => 'Sous-titre', 'type' => 'textarea'],
                    'cta_primary_label' => ['label' => 'Bouton principal', 'type' => 'text'],
                    'cta_secondary_label' => ['label' => 'Bouton secondaire', 'type' => 'text'],
                ],
            ],
            'about' => [
                'label' => 'Section « L\'entreprise »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                    'mission' => ['label' => 'Paragraphe mission', 'type' => 'textarea'],
                ],
            ],
            'activities' => [
                'label' => 'Section « Nos métiers » (aperçu)',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'technology' => [
                'label' => 'Section « Innovation »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'equipment' => [
                'label' => 'Section « Équipements » (aperçu)',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'hse' => [
                'label' => 'Section « HSE » (aperçu)',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'realisations' => [
                'label' => 'Section « Réalisations »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'careers' => [
                'label' => 'Section « Carrières »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'gallery' => [
                'label' => 'Section « Galerie » (aperçu)',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'actualites_teaser' => [
                'label' => 'Section « Actualités » (aperçu)',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'contact' => [
                'label' => 'Section « Contact »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
        ],

        'about' => [
            'intro' => [
                'label' => 'En-tête de page',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'histoire' => [
                'label' => 'Section « Histoire »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'paragraphs' => ['label' => 'Récit (un paragraphe par ligne vide)', 'type' => 'textarea'],
                ],
            ],
            'expertise' => [
                'label' => 'Section « Domaines d\'expertise »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'pillars' => [
                'label' => 'Section « Vision, mission & objectifs »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                ],
            ],
            'timeline' => [
                'label' => 'Section « Frise »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                ],
            ],
            'values' => [
                'label' => 'Section « Nos valeurs »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                ],
            ],
            'cta' => [
                'label' => 'Bandeau « Rejoignez-nous »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte', 'type' => 'textarea'],
                    'button_label' => ['label' => 'Bouton', 'type' => 'text'],
                ],
            ],
        ],

        'metiers' => [
            'intro' => [
                'label' => 'En-tête de page',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'innovation' => [
                'label' => 'Section « Innovation »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'cta' => [
                'label' => 'Bandeau « Rejoignez-nous »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte', 'type' => 'textarea'],
                    'button_label' => ['label' => 'Bouton', 'type' => 'text'],
                ],
            ],
        ],

        'hse' => [
            'intro' => [
                'label' => 'En-tête de page',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'engagements' => [
                'label' => 'Section « Nos engagements »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                ],
            ],
            'method' => [
                'label' => 'Section « Notre méthode »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
        ],

        'equipements' => [
            'intro' => [
                'label' => 'En-tête de page',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'base' => [
                'label' => 'Section « Base de Djeno »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte d\'introduction', 'type' => 'textarea'],
                ],
            ],
            'cta' => [
                'label' => 'Bandeau « Rejoignez-nous »',
                'fields' => [
                    'kicker' => ['label' => 'Kicker', 'type' => 'text'],
                    'title' => ['label' => 'Titre', 'type' => 'text'],
                    'lead' => ['label' => 'Texte', 'type' => 'textarea'],
                    'button_label' => ['label' => 'Bouton', 'type' => 'text'],
                ],
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Page labels
    |--------------------------------------------------------------------------
    */
    'labels' => [
        'home' => 'Accueil',
        'about' => 'À propos',
        'metiers' => 'Métiers',
        'hse' => 'HSE',
        'equipements' => 'Équipements',
    ],

];
