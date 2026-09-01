<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="refresh" content="60" />
    <meta name="robots" content="noindex" />
    <title>Maintenance en cours · SFP · Société de Forages Pétroliers</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" />

    {{--
        Page volontairement autonome (ni @extends('layouts.app'), ni resources/css/app.css compilé
        par Vite) : elle doit s'afficher même si la base de données est indisponible pendant une
        migration, ou si `npm run build` est en cours et que le manifeste Vite est temporairement
        absent — exactement les situations où `php artisan down` est utilisé.
    --}}
    <style>
        * { box-sizing: border-box; }
        html, body {
            margin: 0;
            height: 100%;
            background: #0c0e22;
            color: #fff;
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        body {
            display: grid;
            place-items: center;
            padding: 2rem;
        }
        .card {
            text-align: center;
            width: min(440px, 100%);
        }
        .logo {
            height: 110px;
            width: auto;
            margin: 0 auto 1.8rem;
            filter: drop-shadow(0 0 16px rgba(255, 255, 255, 0.5)) drop-shadow(0 6px 30px rgba(250, 231, 0, 0.18));
        }
        .logo-fb {
            display: none;
            font-size: 3rem;
            font-weight: 800;
            letter-spacing: -2px;
            margin-bottom: 1.4rem;
        }
        .logo-fb span { color: #fae700; }
        .name {
            font-size: 0.92rem;
            font-weight: 600;
            letter-spacing: 0.42em;
            text-transform: uppercase;
            opacity: 0.85;
        }
        h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 1.1rem 0 0.6rem;
        }
        p {
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
            margin: 0;
        }
        .bar {
            position: relative;
            height: 2px;
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            margin-top: 2.2rem;
            overflow: hidden;
        }
        .bar::after {
            content: '';
            position: absolute;
            inset: 0;
            width: 40%;
            background: linear-gradient(90deg, transparent, #fae700, transparent);
            animation: load 1.3s ease-in-out infinite;
        }
        @keyframes load {
            0% { left: -40%; }
            100% { left: 100%; }
        }
        .contact {
            margin-top: 2.2rem;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.45);
        }
        .contact a { color: rgba(255, 255, 255, 0.75); text-decoration: none; }
        .contact a:hover { text-decoration: underline; }
    </style>
</head>

<body>
    <div class="card">
        <img
            src="{{ asset('images/logo-inverse.png') }}"
            alt="SFP"
            class="logo"
            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
        />
        <div class="logo-fb">SFP<span>.</span></div>
        <div class="name">Société de Forages Pétroliers</div>

        <h1>Maintenance en cours</h1>
        <p>Le site est en cours de mise à jour. Nous serons de retour dans quelques instants — cette page se recharge automatiquement.</p>

        <div class="bar"></div>

        <p class="contact">
            Besoin de nous joindre entretemps ? <a href="tel:+242065870728">+242 06 587 07 28</a>
            · <a href="mailto:contact@snpc-sfp.net">contact@snpc-sfp.net</a>
        </p>
    </div>
</body>

</html>
