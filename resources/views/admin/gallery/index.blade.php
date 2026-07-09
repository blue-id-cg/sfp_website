<x-app-layout>
    <x-slot name="header">Galerie</x-slot>

    <x-admin.page-header title="Galerie" subtitle="{{ $images->total() }} photo(s) au total.">
        <x-slot:actions>
            <a href="{{ route('admin.gallery.create') }}" class="inline-flex items-center gap-2 rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                <i class="hgi-stroke hgi-add-01 text-xs"></i> Ajouter une image
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    @if (session('status'))
        <p class="mb-5 inline-flex items-center gap-2 rounded-md border border-green-200 bg-green-50 px-3 py-2 text-sm text-green-700">
            <i class="hgi-stroke hgi-checkmark-circle-01"></i> {{ session('status') }}
        </p>
    @endif

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
        @forelse ($images as $image)
            <div class="group rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden transition hover:shadow-md">
                <div class="relative overflow-hidden">
                    <img src="{{ $image->image_url }}" alt="{{ $image->title }}" class="h-40 w-full object-cover transition duration-300 group-hover:scale-105" />
                    <span class="absolute left-2 top-2 rounded-full bg-black/60 px-2 py-0.5 text-[0.65rem] font-semibold text-white">#{{ $image->position }}</span>
                </div>
                <div class="p-3">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $image->title ?: 'Sans titre' }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $image->caption }}</p>
                    <div class="mt-2 flex items-center justify-between text-sm">
                        <a href="{{ route('admin.gallery.edit', $image) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:underline">
                            <i class="hgi-stroke hgi-edit-02 text-xs"></i> Modifier
                        </a>
                        <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" onsubmit="return confirm('Supprimer cette image ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1.5 text-red-600 hover:underline">
                                <i class="hgi-stroke hgi-delete-02 text-xs"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-gray-200 bg-white py-10 text-center text-gray-500">
                <i class="hgi-stroke hgi-image-02 mb-2 block text-2xl text-gray-300"></i>
                Aucune image pour le moment.
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $images->links() }}
    </div>
</x-app-layout>
