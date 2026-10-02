<x-app-layout>
    <x-slot name="header">Modifier l'actualité</x-slot>

    <x-admin.page-header title="Modifier l'actualité" subtitle="{{ $actualite->title }}">
        <x-slot:actions>
            @if ($actualite->published_at?->lessThanOrEqualTo(now()))
                <a href="{{ route('actualites.show', $actualite) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 rounded-md border border-gray-200 px-3 py-1.5 text-sm font-medium text-gray-700 hover:border-gray-400">
                    Voir sur le site ↗
                </a>
            @else
                <span class="inline-flex items-center gap-1.5 rounded-md border border-gray-200 px-3 py-1.5 text-sm text-gray-400">
                    Brouillon — pas encore publié
                </span>
            @endif
        </x-slot:actions>
    </x-admin.page-header>

    <div class="form-card max-w-3xl">
        <form method="POST" action="{{ route('admin.actualites.update', $actualite) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.actualites.form')
        </form>
    </div>
</x-app-layout>
