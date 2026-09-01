<x-app-layout>
    <x-slot name="header">Réalisations</x-slot>

    <x-admin.page-header title="Réalisations" subtitle="{{ $realisations->total() }} réalisation(s) au total.">
        <x-slot:actions>
            <a href="{{ route('admin.realisations.create') }}" class="inline-flex items-center gap-2 rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                <i class="hgi-stroke hgi-add-01 text-xs"></i> Nouvelle réalisation
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <form method="GET" class="relative mb-5 max-w-sm">
        <i class="hgi-stroke hgi-search-01 absolute left-3 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
        <input type="search" name="q" value="{{ $search }}" placeholder="Rechercher une réalisation…" class="w-full rounded-md border border-gray-200 py-2 pl-9 pr-3 text-sm focus:border-gray-400 focus:outline-none" />
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse ($realisations as $realisation)
            <div class="group rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden transition hover:shadow-md">
                <div class="relative h-36 overflow-hidden bg-gray-100">
                    @if ($realisation->image_url)
                        <img src="{{ $realisation->image_url }}" alt="" class="h-full w-full object-cover transition duration-300 group-hover:scale-105" />
                    @else
                        <div class="flex h-full items-center justify-center text-gray-300">
                            <i class="hgi-stroke hgi-image-02 text-2xl"></i>
                        </div>
                    @endif
                    <span class="absolute left-2 top-2 rounded-full px-2.5 py-1 text-[0.65rem] font-semibold {{ $realisation->published_at ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ $realisation->published_at ? 'Publiée' : 'Brouillon' }}
                    </span>
                </div>
                <div class="p-4">
                    @if ($realisation->category)
                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-400">{{ $realisation->category }}</span>
                    @endif
                    <p class="mt-1 font-medium text-gray-900">{{ $realisation->title }}</p>
                    <div class="mt-4 flex items-center justify-between border-t border-gray-100 pt-3 text-sm">
                        <span class="text-xs text-gray-400">Position {{ $realisation->position }}</span>
                        <div class="space-x-3">
                            <a href="{{ route('admin.realisations.edit', $realisation) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:underline">
                                <i class="hgi-stroke hgi-edit-02 text-xs"></i> Modifier
                            </a>
                            <form method="POST" action="{{ route('admin.realisations.destroy', $realisation) }}" class="inline" onsubmit="return confirm('Supprimer cette réalisation ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 text-red-600 hover:underline">
                                    <i class="hgi-stroke hgi-delete-02 text-xs"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-xl border border-dashed border-gray-200 bg-white py-10 text-center text-gray-500">
                <i class="hgi-stroke hgi-image-02 mb-2 block text-2xl text-gray-300"></i>
                {{ $search !== '' ? 'Aucune réalisation ne correspond à votre recherche.' : 'Aucune réalisation pour le moment.' }}
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $realisations->links() }}
    </div>
</x-app-layout>
