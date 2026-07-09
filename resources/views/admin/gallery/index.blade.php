<x-app-layout>
    <x-slot name="header">Galerie</x-slot>

    <div class="flex items-center justify-between mb-4">
        @if (session('status'))
            <p class="text-sm text-green-700 bg-green-50 border border-green-200 rounded-md px-3 py-2">{{ session('status') }}</p>
        @endif
        <a href="{{ route('admin.gallery.create') }}" class="ml-auto inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
            Ajouter une image
        </a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse ($images as $image)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <img src="{{ $image->image_url }}" alt="{{ $image->title }}" class="h-40 w-full object-cover" />
                <div class="p-3">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ $image->title ?: 'Sans titre' }}</p>
                    <p class="text-xs text-gray-500 truncate">{{ $image->caption }}</p>
                    <div class="mt-2 flex items-center justify-between text-sm">
                        <a href="{{ route('admin.gallery.edit', $image) }}" class="text-blue-600 hover:underline">Modifier</a>
                        <form method="POST" action="{{ route('admin.gallery.destroy', $image) }}" onsubmit="return confirm('Supprimer cette image ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500 col-span-full">Aucune image pour le moment.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $images->links() }}
    </div>
</x-app-layout>
