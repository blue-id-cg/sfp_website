<x-app-layout>
    <x-slot name="header">Actualités</x-slot>

    <x-admin.page-header title="Actualités" subtitle="{{ $actualites->total() }} publication(s) au total.">
        <x-slot:actions>
            <a href="{{ route('admin.actualites.create') }}" class="inline-flex items-center gap-2 rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                <i class="hgi-stroke hgi-add-01 text-xs"></i> Nouvelle actualité
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    @if (session('status'))
        <p class="mb-5 inline-flex items-center gap-2 rounded-md border border-green-200 bg-green-50 px-3 py-2 text-sm text-green-700">
            <i class="hgi-stroke hgi-checkmark-circle-01"></i> {{ session('status') }}
        </p>
    @endif

    <form method="GET" class="relative mb-5 max-w-sm">
        <i class="hgi-stroke hgi-search-01 absolute left-3 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
        <input type="search" name="q" value="{{ $search }}" placeholder="Rechercher une actualité…" class="w-full rounded-md border border-gray-200 py-2 pl-9 pr-3 text-sm focus:border-gray-400 focus:outline-none" />
    </form>

    <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-4 py-3">Titre</th>
                    <th class="px-4 py-3">Catégorie</th>
                    <th class="px-4 py-3">Publication</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($actualites as $actualite)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $actualite->image_url }}" alt="" class="h-9 w-9 shrink-0 rounded-md object-cover" />
                                <span class="font-medium text-gray-900">{{ $actualite->title }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $actualite->category ?? '—' }}</td>
                        <td class="px-4 py-3">
                            @if ($actualite->published_at)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700">
                                    <i class="hgi-stroke hgi-circle text-[6px]"></i> {{ $actualite->date_label }}
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600">
                                    <i class="hgi-stroke hgi-circle text-[6px]"></i> Brouillon
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.actualites.edit', $actualite) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:underline">
                                <i class="hgi-stroke hgi-edit-02 text-xs"></i> Modifier
                            </a>
                            <form method="POST" action="{{ route('admin.actualites.destroy', $actualite) }}" class="inline" onsubmit="return confirm('Supprimer cette actualité ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1.5 text-red-600 hover:underline">
                                    <i class="hgi-stroke hgi-delete-02 text-xs"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-10 text-center text-gray-500">
                            <i class="hgi-stroke hgi-news-01 mb-2 block text-2xl text-gray-300"></i>
                            {{ $search !== '' ? 'Aucune actualité ne correspond à votre recherche.' : 'Aucune actualité pour le moment.' }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>

    <div class="mt-4">
        {{ $actualites->links() }}
    </div>
</x-app-layout>
