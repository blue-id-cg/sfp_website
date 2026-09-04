<x-app-layout>
    <x-slot name="header">Frise chronologique</x-slot>

    <x-admin.page-header title="Frise chronologique" subtitle="{{ $milestones->total() }} étape(s) — page « À propos ».">
        <x-slot:actions>
            <a href="{{ route('admin.milestones.create') }}" class="inline-flex items-center gap-2 rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                <i class="hgi-stroke hgi-add-01 text-xs"></i> Nouvelle étape
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-4 py-3">Année</th>
                    <th class="px-4 py-3">Catégorie</th>
                    <th class="px-4 py-3">Titre</th>
                    <th class="px-4 py-3">Position</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($milestones as $milestone)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $milestone->year_label }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $milestone->category ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-900">{{ $milestone->title }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $milestone->position }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.milestones.edit', $milestone) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:underline">
                                <i class="hgi-stroke hgi-edit-02 text-xs"></i> Modifier
                            </a>
                            <form method="POST" action="{{ route('admin.milestones.destroy', $milestone) }}" class="inline" data-confirm data-confirm-title="Supprimer cette étape ?" data-confirm-message="Cette étape sera définitivement supprimée.">
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
                            <i class="hgi-stroke hgi-flag-01 mb-2 block text-2xl text-gray-300"></i>
                            Aucune étape pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>

    <div class="mt-4">
        {{ $milestones->links() }}
    </div>
</x-app-layout>
