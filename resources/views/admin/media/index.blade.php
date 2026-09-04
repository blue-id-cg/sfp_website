<x-app-layout>
    <x-slot name="header">Médiathèque</x-slot>

    <x-admin.page-header
        title="Médiathèque"
        subtitle="{{ $pickerFor ? 'Choisissez une image, ou ajoutez-en une nouvelle.' : $media->total().' fichier(s) au total.' }}"
    />

    <div class="form-card mb-6">
        <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data">
            @csrf
            <x-admin.file-field name="file" label="Ajouter une image" required />
            <x-admin.field name="alt_text" label="Texte alternatif" hint="Décrit l'image pour l'accessibilité et le SEO.">
                <input type="text" name="alt_text" id="alt_text" value="{{ old('alt_text') }}" class="@error('alt_text') invalid @enderror" />
            </x-admin.field>
            <div class="mt-4">
                <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                    Envoyer
                </button>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
        @forelse ($media as $item)
            <div class="group rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden transition hover:shadow-md">
                @if ($pickerFor && $returnTo)
                    <a href="{{ $returnTo }}{{ str_contains($returnTo, '?') ? '&' : '?' }}{{ $pickerFor }}_media_id={{ $item->id }}" class="block">
                        <img src="{{ $item->url }}" alt="{{ $item->alt_text }}" class="h-32 w-full object-cover transition duration-300 group-hover:scale-105" />
                    </a>
                @else
                    <img src="{{ $item->url }}" alt="{{ $item->alt_text }}" class="h-32 w-full object-cover transition duration-300 group-hover:scale-105" />
                @endif
                <div class="p-3">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $item->alt_text ?: $item->original_name }}</p>
                    @unless ($pickerFor)
                        <form method="POST" action="{{ route('admin.media.destroy', $item) }}" class="mt-2" data-confirm data-confirm-title="Supprimer ce fichier ?" data-confirm-message="Ce fichier sera définitivement supprimé.">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1.5 text-sm text-red-600 hover:underline">
                                <i class="hgi-stroke hgi-delete-02 text-xs"></i> Supprimer
                            </button>
                        </form>
                    @endunless
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-gray-200 bg-white py-10 text-center text-gray-500">
                <i class="hgi-stroke hgi-image-02 mb-2 block text-2xl text-gray-300"></i>
                Aucun fichier pour le moment.
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $media->links() }}
    </div>
</x-app-layout>
