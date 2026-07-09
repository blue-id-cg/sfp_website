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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800&display=swap" />
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="admin-shell antialiased">
    <div class="min-h-screen md:flex">
        <aside id="admin-sidebar" class="a-sidebar hidden md:flex md:flex-col w-64 shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-5 border-b" style="border-color: var(--a-border);">
                <img src="{{ asset('images/logo2.png') }}" alt="SFP" class="h-8 w-auto" />
                <div class="leading-tight">
                    <span class="block text-sm font-semibold" style="color: var(--a-ink);">Administration</span>
                    <span class="block text-[0.65rem] uppercase tracking-widest" style="color: var(--a-muted);">Espace SFP</span>
                </div>
            </a>

            <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">
                <p class="px-3 pb-2 text-[0.65rem] font-semibold uppercase tracking-widest" style="color: var(--a-muted);">Pilotage</p>
                <a href="{{ route('admin.dashboard') }}" class="a-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="hgi-stroke hgi-dashboard-speed-01 w-4 text-center"></i> Tableau de bord
                </a>

                <p class="px-3 pb-2 pt-4 text-[0.65rem] font-semibold uppercase tracking-widest" style="color: var(--a-muted);">Contenu</p>
                <a href="{{ route('admin.actualites.index') }}" class="a-nav-link {{ request()->routeIs('admin.actualites.*') ? 'active' : '' }}">
                    <i class="hgi-stroke hgi-news-01 w-4 text-center"></i> Actualités
                </a>
                <a href="{{ route('admin.offres.index') }}" class="a-nav-link {{ request()->routeIs('admin.offres.*') ? 'active' : '' }}">
                    <i class="hgi-stroke hgi-briefcase-01 w-4 text-center"></i> Offres d'emploi
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="a-nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                    <i class="hgi-stroke hgi-image-02 w-4 text-center"></i> Galerie
                </a>

                <p class="px-3 pb-2 pt-4 text-[0.65rem] font-semibold uppercase tracking-widest" style="color: var(--a-muted);">Échanges</p>
                <a href="{{ route('admin.messages.index') }}" class="a-nav-link justify-between {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <span class="flex items-center gap-3"><i class="hgi-stroke hgi-mail-01 w-4 text-center"></i> Messages</span>
                    @php($unread = \App\Models\ContactMessage::query()->whereNull('read_at')->count())
                    @if ($unread > 0)
                        <span class="rounded-full px-1.5 py-0.5 text-[0.65rem] font-bold leading-none" style="background: var(--a-accent); color: var(--a-ink);">{{ $unread }}</span>
                    @endif
                </a>
            </nav>

            <div class="border-t px-3 py-4" style="border-color: var(--a-border);">
                <a href="{{ route('home') }}" target="_blank" class="a-nav-link">
                    <i class="hgi-stroke hgi-square-arrow-up-right w-4 text-center"></i> Voir le site public
                </a>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="flex items-center justify-between gap-4 border-b px-4 py-3 md:px-8" style="background: rgba(255,255,255,0.75); backdrop-filter: blur(10px); border-color: var(--a-border);">
                <button type="button" data-admin-menu-toggle class="md:hidden inline-flex items-center justify-center rounded-md p-2 hover:bg-gray-100" style="color: var(--a-ink-soft);">
                    <i class="hgi-stroke hgi-menu-01"></i>
                </button>

                <p class="hidden md:flex items-center gap-1.5 text-sm" style="color: var(--a-muted);">
                    <i class="hgi-stroke hgi-home-01 text-xs"></i>
                    <span>/</span>
                    <span>{{ isset($header) ? strip_tags($header) : 'Tableau de bord' }}</span>
                </p>

                <div class="relative ml-auto" data-user-menu>
                    <button type="button" data-user-menu-toggle class="flex items-center gap-2.5 rounded-full py-1 pl-1 pr-3 hover:bg-gray-50">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full text-xs font-semibold text-white" style="background: var(--a-ink);">
                            {{ mb_strtoupper(mb_substr(auth()->user()?->name ?? '?', 0, 1)) }}
                        </span>
                        <span class="hidden sm:block text-sm font-medium" style="color: var(--a-ink);">{{ auth()->user()?->name }}</span>
                        <i class="hgi-stroke hgi-arrow-down-01 text-xs" style="color: var(--a-muted);"></i>
                    </button>

                    <div data-user-menu-panel class="hidden absolute right-0 top-full z-20 mt-2 w-48 rounded-lg border bg-white py-1.5 shadow-lg" style="border-color: var(--a-border);">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm hover:bg-gray-50" style="color: var(--a-ink-soft);">
                            <i class="hgi-stroke hgi-user w-4 text-center"></i> Mon profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-2.5 px-4 py-2 text-sm hover:bg-gray-50" style="color: var(--a-ink-soft);">
                                <i class="hgi-stroke hgi-logout-01 w-4 text-center"></i> Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 md:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
