<x-app-layout>
    <x-slot name="header">Modifier l'image</x-slot>

    <x-admin.page-header title="Modifier l'image" subtitle="{{ $image->title ?: 'Sans titre' }}">
        <x-slot:actions>
            <a href="{{ route('galerie.index') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 rounded-md border border-gray-200 px-3 py-1.5 text-sm font-medium text-gray-700 hover:border-gray-400">
                Voir sur le site ↗
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="form-card max-w-xl">
        <form method="POST" action="{{ route('admin.gallery.update', $image) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.gallery.form')
        </form>
    </div>
</x-app-layout>
