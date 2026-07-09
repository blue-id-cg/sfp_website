@extends('layouts.app', [
    'title' => 'Politique de confidentialité · SFP · Société de Forages Pétroliers',
    'description' => 'Comment la Société de Forages Pétroliers (SFP) collecte, utilise et protège vos données personnelles.',
])

@section('content')
    @include('partials.page-head', [
        'image' => 'crew-mudpumps',
        'breadcrumbs' => [
            ['label' => 'Accueil', 'url' => route('home')],
            ['label' => 'Politique de confidentialité', 'url' => null],
        ],
        'kicker' => 'Informations légales',
        'title' => 'Politique de confidentialité',
    ])

    <article class="section">
        <div class="wrap">
            <div class="article">
                <p class="lead">La SFP attache une grande importance à la protection des données personnelles des visiteurs et utilisateurs de son site.</p>

                <h2>Données collectées</h2>
                <p>Nous collectons uniquement les données que vous nous transmettez volontairement, notamment via :</p>
                <ul class="dotted">
                    <li>Le formulaire de contact : nom, e-mail, téléphone (facultatif), objet et message.</li>
                    <li>Le formulaire de candidature spontanée : les mêmes informations, dans le cadre d'une démarche de recrutement.</li>
                </ul>

                <h2>Finalité du traitement</h2>
                <p>Ces données sont utilisées exclusivement pour répondre à vos demandes, traiter vos candidatures et assurer le suivi de nos échanges. Elles ne sont ni revendues ni transmises à des tiers à des fins commerciales.</p>

                <h2>Durée de conservation</h2>
                <p>Les données transmises via le formulaire de contact sont conservées le temps nécessaire au traitement de votre demande, puis archivées ou supprimées selon nos obligations légales et nos besoins opérationnels.</p>

                <h2>Vos droits</h2>
                <p>Conformément à la réglementation applicable, vous disposez d'un droit d'accès, de rectification et de suppression des données vous concernant. Pour exercer ce droit, contactez-nous à l'adresse <a href="mailto:contact@snpc-sfp.net">contact@snpc-sfp.net</a>.</p>

                <h2>Sécurité</h2>
                <p>La SFP met en œuvre les mesures techniques et organisationnelles raisonnables pour protéger vos données contre tout accès non autorisé, perte ou divulgation.</p>

                <h2>Cookies</h2>
                <p>Notre site utilise des cookies. Pour en savoir plus sur leur nature et sur la manière de gérer vos préférences, consultez notre <a href="{{ route('legal.cookies') }}">politique de cookies</a>.</p>
            </div>
        </div>
    </article>
@endsection
