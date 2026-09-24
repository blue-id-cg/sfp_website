<x-app-layout>
    <x-slot name="header">Métiers</x-slot>

    <x-admin.page-header title="Métiers" subtitle="{{ $trades->count() }} métier(s) affiché(s) sur la page publique.">
        <x-slot:actions>
            <a href="{{ route('admin.trades.create') }}" class="inline-flex items-center gap-2 rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                <i class="hgi-stroke hgi-add-01 text-xs"></i> Nouveau métier
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-4 py-3">Position</th>
                    <th class="px-4 py-3">Titre</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($trades as $trade)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-4 py-3 text-gray-500">{{ $trade->position }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if ($trade->icon)
                                    <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-gray-50 text-gray-500">
                                        <i class="hgi-stroke {{ $trade->icon }}"></i>
                                    </span>
                                @endif
                                <span class="font-medium text-gray-900">{{ $trade->title }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ Str::limit($trade->description, 80) }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('metiers.show', $trade) }}" target="_blank" class="inline-flex items-center gap-1.5 text-gray-500 hover:underline">
                                <i class="hgi-stroke hgi-eye text-xs"></i> Voir
                            </a>
                            <a href="{{ route('admin.trades.edit', $trade) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:underline">
                                <i class="hgi-stroke hgi-edit-02 text-xs"></i> Modifier
                            </a>
                            <form method="POST" action="{{ route('admin.trades.destroy', $trade) }}" class="inline" data-confirm data-confirm-title="Supprimer ce métier ?" data-confirm-message="Ce métier sera définitivement supprimé.">
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
                            <i class="hgi-stroke hgi-factory-01 mb-2 block text-2xl text-gray-300"></i>
                            Aucun métier pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>
</x-app-layout>
