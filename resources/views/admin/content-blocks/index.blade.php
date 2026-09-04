<x-app-layout>
    <x-slot name="header">Blocs de contenu</x-slot>

    <x-admin.page-header title="Blocs de contenu" subtitle="{{ $blocksByGroup->flatten()->count() }} bloc(s) — cartes icône + titre + description réutilisées sur le site public.">
        <x-slot:actions>
            <a href="{{ route('admin.content-blocks.create') }}" class="inline-flex items-center gap-2 rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                <i class="hgi-stroke hgi-add-01 text-xs"></i> Nouveau bloc
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <form method="GET" class="mb-5 max-w-xs">
        <select name="group" onchange="this.form.submit()" class="w-full rounded-md border border-gray-200 py-2 px-3 text-sm focus:border-gray-400 focus:outline-none">
            <option value="">Tous les groupes ({{ count($groups) }})</option>
            @foreach ($groups as $group)
                <option value="{{ $group }}" @selected($selectedGroup === $group)>{{ \App\Models\ContentBlock::groupLabel($group) }}</option>
            @endforeach
        </select>
    </form>

    <div class="space-y-5">
        @forelse ($blocksByGroup as $group => $items)
            <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">
                <div class="flex items-center gap-2.5 border-b border-gray-100 bg-gray-50/60 px-4 py-3">
                    <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-gray-500 shadow-sm">
                        <i class="hgi-stroke hgi-dashboard-square-01 text-sm"></i>
                    </span>
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ \App\Models\ContentBlock::groupLabel($group) }}</p>
                        <p class="text-xs text-gray-400">{{ $group }} · {{ $items->count() }} bloc(s)</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                            <tr>
                                <th class="px-4 py-3"></th>
                                <th class="px-4 py-3">Titre</th>
                                <th class="px-4 py-3">Description</th>
                                <th class="px-4 py-3">Données</th>
                                <th class="px-4 py-3">Position</th>
                                <th class="px-4 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($items as $block)
                                <tr class="hover:bg-gray-50/60">
                                    <td class="px-4 py-3">
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gray-50 text-gray-500">
                                            @if ($block->icon)
                                                <i class="hgi-stroke {{ $block->icon }}"></i>
                                            @else
                                                <span class="block h-1.5 w-1.5 rounded-full bg-gray-300"></span>
                                            @endif
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $block->title }}</td>
                                    <td class="px-4 py-3 text-gray-500">
                                        {{ $block->description ? \Illuminate\Support\Str::limit($block->description, 90) : '—' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-500">
                                        {{ $block->meta ? count($block->meta).' donnée(s)' : '—' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-500">{{ $block->position }}</td>
                                    <td class="px-4 py-3 text-right space-x-3">
                                        <a href="{{ route('admin.content-blocks.edit', $block) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:underline">
                                            <i class="hgi-stroke hgi-edit-02 text-xs"></i> Modifier
                                        </a>
                                        <form method="POST" action="{{ route('admin.content-blocks.destroy', $block) }}" class="inline" data-confirm data-confirm-title="Supprimer ce bloc ?" data-confirm-message="Ce bloc de contenu sera définitivement supprimé.">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1.5 text-red-600 hover:underline">
                                                <i class="hgi-stroke hgi-delete-02 text-xs"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="rounded-xl border border-dashed border-gray-200 bg-white py-10 text-center text-gray-500">
                <i class="hgi-stroke hgi-dashboard-square-01 mb-2 block text-2xl text-gray-300"></i>
                Aucun bloc pour le moment.
            </div>
        @endforelse
    </div>
</x-app-layout>
