<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'SFP · Société de Forages Pétroliers' }}</title>
    <meta name="description" content="{{ $description ?? "Société de Forages Pétroliers (SFP), filiale du groupe SNPC. Expertise congolaise du forage pétrolier, de la complétion et du work over." }}" />
    <meta property="og:title" content="{{ $title ?? 'SFP · Société de Forages Pétroliers' }}" />
    <meta property="og:description" content="{{ $description ?? "L'expertise congolaise du forage pétrolier, de la complétion et du work over." }}" />

    <meta name="theme-color" content="#0C0E22" />
    <meta name="author" content="SFP · Société de Forages Pétroliers" />
    <meta name="robots" content="index, follow" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:site_name" content="SFP · Société de Forages Pétroliers" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/opt/rig-tall.jpg') }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <link rel="canonical" href="{{ url()->current() }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/logo1.png') }}" />

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'SFP · Société de Forages Pétroliers',
            'alternateName' => 'SFP',
            'url' => route('home'),
            'logo' => asset('images/logo1.png'),
            'description' => "Société de Forages Pétroliers (SFP), filiale du groupe SNPC. Expertise congolaise du forage pétrolier, de la complétion et du work over.",
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Avenue du Général de Gaulle, B.P. 622',
                'addressLocality' => 'Pointe-Noire',
                'addressCountry' => 'CG',
            ],
            'telephone' => '+242065870728',
            'email' => 'contact@snpc-sfp.net',
            'parentOrganization' => [
                '@type' => 'Organization',
                'name' => 'SNPC · Société Nationale des Pétroles du Congo',
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @hasSection('splash')
        @yield('splash')
    @endif

    @include('partials.navbar')
    @include('partials.mobile-menu')

    @hasSection('scrollspy')
        @yield('scrollspy')
    @endif

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.back-to-top')
    @include('partials.lightbox')

    @stack('scripts')
</body>

</html>
