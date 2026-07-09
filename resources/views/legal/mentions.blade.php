@extends('layouts.app', [
    'title' => 'Mentions légales · SFP · Société de Forages Pétroliers',
    'description' => 'Mentions légales de la Société de Forages Pétroliers (SFP), filiale du groupe SNPC au Congo.',
])

@section('content')
    @include('partials.page-head', [
        'image' => 'rig-tall',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Mentions légales', 'url' => null],
        ],
        'kicker' => 'Informations légales',
        'title' => 'Mentions légales',
    ])

    <article class="section">
        <div class="wrap">
            <div class="article">
                <h2>Éditeur du site</h2>
                <p>
                    Le présent site est édité par la <strong>Société de Forages Pétroliers (SFP)</strong>, Société Anonyme
                    au capital de 100 000 000 Francs CFA, filiale du groupe SNPC (Société Nationale des Pétroles du Congo),
                    dont le siège social est situé Avenue du Général de Gaulle, B.P. 622, Pointe-Noire, République du Congo.
                </p>
                <p>
                    Téléphone : <a href="tel:+242065870728">+242 06 587 07 28</a><br />
                    E-mail : <a href="mailto:contact@snpc-sfp.net">contact@snpc-sfp.net</a>
                </p>

                <h2>Directeur de la publication</h2>
                <p>La direction générale de la SFP assure la publication du présent site.</p>

                <h2>Hébergement</h2>
                <p>Le site est hébergé par un prestataire technique tiers, garantissant la disponibilité et la sécurité de l'infrastructure.</p>

                <h2>Propriété intellectuelle</h2>
                <p>
                    L'ensemble des contenus présents sur ce site (textes, images, photographies, logos, marques) est la
                    propriété exclusive de la SFP ou de ses partenaires, sauf mention contraire. Toute reproduction,
                    représentation, modification ou diffusion, totale ou partielle, sans autorisation préalable est
                    interdite et constitue une contrefaçon.
                </p>

                <h2>Données personnelles</h2>
                <p>
                    Dans le cadre de l'utilisation du formulaire de contact et du formulaire de candidature spontanée,
                    la SFP est amenée à collecter certaines données personnelles : nom, prénom, adresse e-mail, numéro
                    de téléphone (facultatif), objet et contenu du message. Ces données sont exclusivement destinées au
                    traitement de votre demande ou de votre candidature et ne font l'objet d'aucune cession à des tiers.
                </p>
                <p>
                    Conformément à la réglementation applicable en matière de protection des données personnelles, vous
                    disposez d'un droit d'accès, de rectification et de suppression des données vous concernant, que
                    vous pouvez exercer en écrivant à <a href="mailto:contact@snpc-sfp.net">contact@snpc-sfp.net</a>.
                    Pour le détail des traitements, des durées de conservation et de vos droits, consultez notre
                    <a href="{{ route('legal.privacy') }}">politique de confidentialité</a>.
                </p>

                <h2>Responsabilité</h2>
                <p>
                    La SFP s'efforce d'assurer l'exactitude et la mise à jour des informations diffusées sur ce site, sans
                    toutefois pouvoir garantir l'exhaustivité de ces informations. La SFP ne saurait être tenue responsable
                    des erreurs ou omissions, ni de l'indisponibilité temporaire du site.
                </p>

                <h2>Droit applicable</h2>
                <p>Le présent site est soumis au droit congolais. En cas de litige, les tribunaux compétents de la République du Congo seront seuls saisis.</p>
            </div>
        </div>
    </article>
@endsection
