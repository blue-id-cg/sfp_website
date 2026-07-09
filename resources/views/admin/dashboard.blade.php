<x-app-layout>
    <x-slot name="header">Tableau de bord</x-slot>

    <x-admin.page-header title="Bonjour {{ auth()->user()?->name }}" subtitle="Voici un aperçu de l'activité et du contenu publié sur le site SFP." />

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="hgi-stroke hgi-news-01"></i>
                </span>
            </div>
            <p class="mt-4 text-3xl font-bold text-gray-900">{{ $actualitesCount }}</p>
            <p class="text-sm text-gray-500">Actualités</p>
            <a href="{{ route('admin.actualites.index') }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-medium text-gray-700 hover:text-charcoal">
                Gérer <i class="hgi-stroke hgi-arrow-right-01 text-xs"></i>
            </a>
        </div>

        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-orange-50 text-orange-600">
                    <i class="hgi-stroke hgi-briefcase-01"></i>
                </span>
            </div>
            <p class="mt-4 text-3xl font-bold text-gray-900">{{ $offresCount }}</p>
            <p class="text-sm text-gray-500">
                Offres d'emploi
                @if ($draftOffresCount > 0)
                    <span class="text-gray-400">· {{ $draftOffresCount }} brouillon(s)</span>
                @endif
            </p>
            <a href="{{ route('admin.offres.index') }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-medium text-gray-700 hover:text-charcoal">
                Gérer <i class="hgi-stroke hgi-arrow-right-01 text-xs"></i>
            </a>
        </div>

        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                    <i class="hgi-stroke hgi-image-02"></i>
                </span>
            </div>
            <p class="mt-4 text-3xl font-bold text-gray-900">{{ $galleryCount }}</p>
            <p class="text-sm text-gray-500">Photos en galerie</p>
            <a href="{{ route('admin.gallery.index') }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-medium text-gray-700 hover:text-charcoal">
                Gérer <i class="hgi-stroke hgi-arrow-right-01 text-xs"></i>
            </a>
        </div>

        <div class="rounded-xl border border-gray-100 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <span class="flex h-11 w-11 items-center justify-center rounded-lg {{ $unreadMessagesCount > 0 ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600' }}">
                    <i class="hgi-stroke hgi-mail-01"></i>
                </span>
                @if ($unreadMessagesCount > 0)
                    <span class="rounded-full bg-red-100 px-2 py-0.5 text-xs font-semibold text-red-700">Nouveau</span>
                @endif
            </div>
            <p class="mt-4 text-3xl font-bold text-gray-900">{{ $unreadMessagesCount }}</p>
            <p class="text-sm text-gray-500">Messages non lus</p>
            <a href="{{ route('admin.messages.index') }}" class="mt-4 inline-flex items-center gap-1.5 text-sm font-medium text-gray-700 hover:text-charcoal">
                Consulter <i class="hgi-stroke hgi-arrow-right-01 text-xs"></i>
            </a>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-2">
        <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">
            <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
                <h2 class="text-sm font-semibold text-gray-900">Derniers messages</h2>
                <a href="{{ route('admin.messages.index') }}" class="text-xs font-medium text-gray-500 hover:text-gray-800">Tout voir</a>
            </div>
            <ul class="divide-y divide-gray-100">
                @forelse ($recentMessages as $message)
                    <li>
                        <a href="{{ route('admin.messages.show', $message) }}" class="flex items-center justify-between gap-3 px-5 py-3 hover:bg-gray-50/60">
                            <span class="min-w-0">
                                <span class="flex items-center gap-2">
                                    @if (! $message->read_at)
                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-blue-500"></span>
                                    @endif
                                    <span class="truncate text-sm font-medium text-gray-900">{{ $message->name }}</span>
                                </span>
                                <span class="block truncate text-xs text-gray-500">{{ $message->subject ?? $message->message }}</span>
                            </span>
                            <span class="shrink-0 text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</span>
                        </a>
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-gray-400">Aucun message pour le moment.</li>
                @endforelse
            </ul>
        </div>

        <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">
            <div class="flex items-center justify-between border-b border-gray-100 px-5 py-4">
                <h2 class="text-sm font-semibold text-gray-900">Dernières actualités</h2>
                <a href="{{ route('admin.actualites.index') }}" class="text-xs font-medium text-gray-500 hover:text-gray-800">Tout voir</a>
            </div>
            <ul class="divide-y divide-gray-100">
                @forelse ($recentActualites as $actualite)
                    <li>
                        <a href="{{ route('admin.actualites.edit', $actualite) }}" class="flex items-center justify-between gap-3 px-5 py-3 hover:bg-gray-50/60">
                            <span class="min-w-0">
                                <span class="block truncate text-sm font-medium text-gray-900">{{ $actualite->title }}</span>
                                <span class="block truncate text-xs text-gray-500">{{ $actualite->category ?? '—' }}</span>
                            </span>
                            @if ($actualite->published_at)
                                <span class="shrink-0 rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700">Publiée</span>
                            @else
                                <span class="shrink-0 rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-600">Brouillon</span>
                            @endif
                        </a>
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-gray-400">Aucune actualité pour le moment.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
