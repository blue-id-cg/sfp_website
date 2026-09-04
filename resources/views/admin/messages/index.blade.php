<x-app-layout>
    <x-slot name="header">Messages de contact</x-slot>

    <x-admin.page-header title="Messages de contact" subtitle="{{ $messages->total() }} message(s) au total." />

    <div class="mb-6 rounded-xl border border-gray-100 bg-white p-4 shadow-sm md:p-5">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">Boîte de réception</p>
                <p class="mt-1 text-sm text-gray-500">Retrouvez les demandes et candidatures reçues sur le site.</p>
            </div>
            <x-admin.search value="{{ $search }}" placeholder="Nom, e-mail ou sujet…" class="w-full lg:max-w-md">
                <input type="hidden" name="status" value="{{ $status }}" />
            </x-admin.search>
        </div>
        <div class="mt-4 flex flex-wrap items-center gap-2">
            @foreach (['' => 'Tous', 'unread' => 'Non lus', 'read' => 'Lus'] as $value => $label)
                <a href="{{ route('admin.messages.index', array_filter(['q' => $search, 'status' => $value])) }}"
                   class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-xs font-semibold transition-colors {{ $status === $value ? 'border-[#0C0E22] bg-[#0C0E22] text-white' : 'border-gray-200 text-gray-600 hover:border-gray-300 hover:bg-gray-50' }}">
                    @if ($value === 'unread')
                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                    @elseif ($value === 'read')
                        <i class="hgi-stroke hgi-tick-01 text-[11px]"></i>
                    @else
                        <i class="hgi-stroke hgi-inbox text-[11px]"></i>
                    @endif
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
      <div class="overflow-x-auto">
        <table class="w-full min-w-190 text-left text-sm">
            <thead class="border-b border-gray-100 bg-gray-50/80 text-[0.68rem] uppercase tracking-[0.14em] text-gray-400">
                <tr>
                    <th class="px-5 py-3.5">Contact</th>
                    <th class="px-5 py-3.5">Demande</th>
                    <th class="px-5 py-3.5">Reçu le</th>
                    <th class="px-5 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($messages as $message)
                    <tr class="group transition-colors hover:bg-gray-50/70 {{ $message->read_at ? '' : 'bg-blue-50/35' }}">
                        <td class="px-5 py-4 align-top">
                            <a href="{{ route('admin.messages.show', $message) }}" class="flex items-start gap-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#0C0E22] text-xs font-bold text-white">{{ mb_strtoupper(mb_substr($message->name, 0, 1)) }}</span>
                                <span class="min-w-0">
                                    <span class="flex items-center gap-2 font-semibold text-gray-900 group-hover:text-[#0C0E22]">{{ $message->name }} @if (! $message->read_at)<span class="h-1.5 w-1.5 rounded-full bg-blue-500" title="Non lu"></span>@endif</span>
                                    <span class="mt-0.5 block truncate text-xs text-gray-500">{{ $message->email }}</span>
                                </span>
                            </a>
                        </td>
                        <td class="max-w-90 px-5 py-4 align-top">
                            <a href="{{ route('admin.messages.show', $message) }}" class="block">
                                <span class="flex items-center gap-2 font-medium text-gray-800">{{ $message->subject ?? 'Demande sans objet' }}
                            @if ($message->cv_path)
                                <i class="hgi-stroke hgi-file-01 text-gray-400" title="CV joint" aria-label="CV joint"></i>
                            @endif
                                </span>
                                <span class="mt-1 block truncate text-xs text-gray-500">{{ $message->message }}</span>
                            </a>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 align-top text-xs text-gray-500">{{ $message->created_at->format('d/m/Y') }}<span class="mt-0.5 block text-gray-400">{{ $message->created_at->format('H:i') }}</span></td>
                        <td class="px-5 py-4 text-right align-top">
                            <div class="inline-flex items-center gap-1">
                            <a href="{{ route('admin.messages.show', $message) }}" class="inline-flex h-8 w-8 items-center justify-center rounded-md text-gray-500 hover:bg-gray-100 hover:text-[#0C0E22]" title="Consulter" aria-label="Consulter">
                                <i class="hgi-stroke hgi-view text-sm"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="inline" data-confirm data-confirm-title="Supprimer ce message ?" data-confirm-message="Ce message sera définitivement supprimé.">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-md text-gray-400 hover:bg-red-50 hover:text-red-600" title="Supprimer" aria-label="Supprimer">
                                    <i class="hgi-stroke hgi-delete-02 text-sm"></i>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-gray-500">
                            <i class="hgi-stroke hgi-mail-01 mb-2 block text-2xl text-gray-300"></i>
                            {{ $search !== '' || $status !== '' ? 'Aucun message ne correspond à ces critères.' : 'Aucun message pour le moment.' }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</x-app-layout>
