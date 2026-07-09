<x-app-layout>
    <x-slot name="header">Offres d'emploi</x-slot>

    <div class="flex items-center justify-between mb-4">
        @if (session('status'))
            <p class="text-sm text-green-700 bg-green-50 border border-green-200 rounded-md px-3 py-2">{{ session('status') }}</p>
        @endif
        <a href="{{ route('admin.offres.create') }}" class="ml-auto inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
            Nouvelle offre
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500">
                <tr>
                    <th class="px-4 py-3">Titre</th>
                    <th class="px-4 py-3">Tags</th>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($offres as $offre)
                    <tr>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $offre->title }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ implode(', ', $offre->tags ?? []) }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $offre->published_at ? 'Publiée' : 'Brouillon' }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.offres.edit', $offre) }}" class="text-blue-600 hover:underline">Modifier</a>
                            <form method="POST" action="{{ route('admin.offres.destroy', $offre) }}" class="inline" onsubmit="return confirm('Supprimer cette offre ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">Aucune offre pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $offres->links() }}
    </div>
</x-app-layout>
