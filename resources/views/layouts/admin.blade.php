<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>{{ isset($header) ? strip_tags($header).' · ' : '' }}Administration SFP</title>

    <link rel="icon" type="image/png" href="{{ asset('images/logo1.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans text-gray-900 antialiased">
    <div class="min-h-screen md:flex">
        <aside id="admin-sidebar" class="hidden md:flex md:flex-col w-64 bg-[#0C0E22] text-white shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-5 border-b border-white/10">
                <img src="{{ asset('images/logo-inverse.png') }}" alt="SFP" class="h-9 w-auto" />
                <span class="font-semibold">Administration</span>
            </a>

            <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block rounded-md px-3 py-2 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    Tableau de bord
                </a>
                <a href="{{ route('admin.actualites.index') }}" class="block rounded-md px-3 py-2 {{ request()->routeIs('admin.actualites.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    Actualités
                </a>
                <a href="{{ route('admin.offres.index') }}" class="block rounded-md px-3 py-2 {{ request()->routeIs('admin.offres.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    Offres d'emploi
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="block rounded-md px-3 py-2 {{ request()->routeIs('admin.gallery.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    Galerie
                </a>
                <a href="{{ route('admin.messages.index') }}" class="block rounded-md px-3 py-2 {{ request()->routeIs('admin.messages.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    Messages de contact
                </a>
            </nav>

            <div class="border-t border-white/10 px-3 py-4 space-y-1 text-sm">
                <a href="{{ route('profile.edit') }}" class="block rounded-md px-3 py-2 {{ request()->routeIs('profile.edit') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                    {{ auth()->user()?->name }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left rounded-md px-3 py-2 text-white/70 hover:bg-white/5 hover:text-white">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="flex items-center justify-between gap-4 bg-white border-b border-gray-200 px-4 py-3 md:px-8 md:py-5">
                <button type="button" data-admin-menu-toggle class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:bg-gray-100">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="min-w-0">
                    @isset($header)
                        <h1 class="text-lg font-semibold text-gray-900 truncate">{{ $header }}</h1>
                    @endisset
                </div>

                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700 shrink-0">Voir le site public</a>
            </header>

            <main class="flex-1 p-4 md:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>

    <script>
        document.querySelector('[data-admin-menu-toggle]')?.addEventListener('click', () => {
            document.getElementById('admin-sidebar')?.classList.toggle('hidden');
            document.getElementById('admin-sidebar')?.classList.toggle('flex');
        });
    </script>
</body>
</html>
