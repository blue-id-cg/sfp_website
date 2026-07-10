<x-app-layout>
    <x-slot name="header">Messages de contact</x-slot>

    <x-admin.page-header title="Messages de contact" subtitle="{{ $messages->total() }} message(s) au total." />

    @if (session('status'))
        <p class="mb-5 inline-flex items-center gap-2 rounded-md border border-green-200 bg-green-50 px-3 py-2 text-sm text-green-700">
            <i class="hgi-stroke hgi-checkmark-circle-01"></i> {{ session('status') }}
        </p>
    @endif

    <div class="flex flex-wrap items-center gap-3 mb-5">
        <div class="inline-flex rounded-md border border-gray-200 bg-white p-1 text-sm">
            @foreach (['' => 'Tous', 'unread' => 'Non lus', 'read' => 'Lus'] as $value => $label)
                <a href="{{ route('admin.messages.index', array_filter(['q' => $search, 'status' => $value])) }}"
                   class="rounded px-3 py-1.5 font-medium transition-colors {{ $status === $value ? 'bg-[#0C0E22] text-white' : 'text-gray-600 hover:bg-gray-50' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
        <form method="GET" class="relative flex-1 min-w-[220px] max-w-sm">
            <input type="hidden" name="status" value="{{ $status }}" />
            <i class="hgi-stroke hgi-search-01 absolute left-3 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
            <input type="search" name="q" value="{{ $search }}" placeholder="Rechercher nom, e-mail, sujet…" class="w-full rounded-md border border-gray-200 py-2 pl-9 pr-3 text-sm focus:border-gray-400 focus:outline-none" />
        </form>
    </div>

    <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-4 py-3">Statut</th>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Sujet</th>
                    <th class="px-4 py-3">Reçu le</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($messages as $message)
                    <tr class="hover:bg-gray-50/60 {{ $message->read_at ? '' : 'font-semibold bg-blue-50/40' }}">
                        <td class="px-4 py-3">
                            @if (! $message->read_at)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-medium text-blue-700">
                                    <i class="hgi-stroke hgi-circle text-[6px]"></i> Non lu
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-500">
                                    <i class="hgi-stroke hgi-tick-01 text-[10px]"></i> Lu
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-900">{{ $message->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $message->email }}</td>
                        <td class="px-4 py-3 text-gray-500">
                            {{ $message->subject ?? '—' }}
                            @if ($message->cv_path)
                                <i class="hgi-stroke hgi-file-01 ml-1 text-gray-400" title="CV joint"></i>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.messages.show', $message) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:underline">
                                <i class="hgi-stroke hgi-view text-xs"></i> Consulter
                            </a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="inline" onsubmit="return confirm('Supprimer ce message ?');">
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
