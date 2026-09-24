<x-app-layout>
    <x-slot name="header">Équipements</x-slot>

    <x-admin.page-header title="Équipements" subtitle="{{ $equipment->count() }} équipement(s) affiché(s) sur la page publique.">
        <x-slot:actions>
            <a href="{{ route('admin.equipment.create') }}" class="inline-flex items-center gap-2 rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                <i class="hgi-stroke hgi-add-01 text-xs"></i> Nouvel équipement
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
                    <th class="px-4 py-3">Métiers</th>
                    <th class="px-4 py-3">Fiche technique</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($equipment as $item)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-4 py-3 text-gray-500">{{ $item->position }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                @if ($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="" class="h-9 w-9 shrink-0 rounded-md object-cover" />
                                @endif
                                <span class="font-medium text-gray-900">{{ $item->title }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $item->trades->pluck('title')->implode(', ') ?: '—' }}</td>
                        <td class="px-4 py-3 text-gray-500">
                            @if ($item->spec_sheet)
                                <span class="inline-flex items-center gap-1.5 text-green-700"><i class="hgi-stroke hgi-file-01 text-xs"></i> En ligne</span>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('equipements.index') }}" target="_blank" class="inline-flex items-center gap-1.5 text-gray-500 hover:underline">
                                <i class="hgi-stroke hgi-eye text-xs"></i> Voir
                            </a>
                            <a href="{{ route('admin.equipment.edit', $item) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:underline">
                                <i class="hgi-stroke hgi-edit-02 text-xs"></i> Modifier
                            </a>
                            <form method="POST" action="{{ route('admin.equipment.destroy', $item) }}" class="inline" data-confirm data-confirm-title="Supprimer cet équipement ?" data-confirm-message="Cet équipement sera définitivement supprimé.">
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
                        <td colspan="5" class="px-4 py-10 text-center text-gray-500">
                            <i class="hgi-stroke hgi-tools mb-2 block text-2xl text-gray-300"></i>
                            Aucun équipement pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>
</x-app-layout>
