<x-app-layout>
    <x-slot name="header">Message de {{ $message->name }}</x-slot>

    <x-admin.page-header title="Message de {{ $message->name }}" subtitle="Reçu le {{ $message->created_at->format('d/m/Y à H:i') }}">
        <x-slot:actions>
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                <i class="hgi-stroke hgi-arrow-left-01 text-xs"></i> Retour
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="grid max-w-5xl gap-5 lg:grid-cols-[minmax(0,1fr)_18rem]">
        <article class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
            <div class="border-b border-gray-100 bg-linear-to-br from-[#0C0E22] to-[#22214a] px-5 py-6 text-white md:px-7">
                <div class="flex items-start gap-4">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#fae700] text-lg font-bold text-[#0C0E22]">{{ mb_strtoupper(mb_substr($message->name, 0, 1)) }}</span>
                    <div class="min-w-0">
                        <p class="text-lg font-semibold">{{ $message->name }}</p>
                        <a href="mailto:{{ $message->email }}" class="mt-1 block truncate text-sm text-white/70 hover:text-white">{{ $message->email }}</a>
                    </div>
                </div>
            </div>

            <div class="space-y-6 p-5 md:p-7">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">Sujet</p>
                    <h2 class="mt-2 text-xl font-semibold text-gray-900">{{ $message->subject ?? 'Demande sans objet' }}</h2>
                </div>

                <div class="border-t border-gray-100 pt-5">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">Message</p>
                    <p class="whitespace-pre-line text-[0.95rem] leading-7 text-gray-700">{{ $message->message }}</p>
                </div>

                @if ($message->cv_path)
                    <div class="flex items-center justify-between gap-4 rounded-lg border border-gray-200 bg-gray-50 p-3">
                        <div class="flex min-w-0 items-center gap-3">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-white text-gray-500 shadow-sm"><i class="hgi-stroke hgi-file-01"></i></span>
                            <span class="min-w-0"><span class="block text-xs font-semibold uppercase tracking-wide text-gray-400">Pièce jointe</span><span class="mt-0.5 block truncate text-sm font-medium text-gray-800">{{ $message->cv_filename }}</span></span>
                        </div>
                        <a href="{{ route('admin.messages.cv', $message) }}" class="inline-flex shrink-0 items-center gap-1.5 rounded-md bg-[#0C0E22] px-3 py-2 text-xs font-semibold text-white hover:bg-[#22214a]">
                            <i class="hgi-stroke hgi-download-01"></i> Télécharger
                        </a>
                    </div>
                @endif
            </div>
        </article>

        <aside class="h-fit rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">Informations</p>
            <dl class="mt-4 space-y-4 text-sm">
                @if ($message->phone)
                    <div><dt class="text-xs text-gray-400">Téléphone</dt><dd class="mt-1 font-medium text-gray-900">{{ $message->phone }}</dd></div>
                @endif
                <div><dt class="text-xs text-gray-400">Réception</dt><dd class="mt-1 font-medium text-gray-900">{{ $message->created_at->format('d/m/Y à H:i') }}</dd></div>
                <div><dt class="text-xs text-gray-400">Statut</dt><dd class="mt-1 inline-flex items-center gap-1.5 font-medium text-gray-900"><span class="h-1.5 w-1.5 rounded-full {{ $message->read_at ? 'bg-gray-400' : 'bg-blue-500' }}"></span>{{ $message->read_at ? 'Lu' : 'Non lu' }}</dd></div>
            </dl>
        </aside>
    </div>

    <div class="mt-5 flex items-center gap-3">
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" data-confirm data-confirm-title="Supprimer ce message ?" data-confirm-message="Ce message sera définitivement supprimé.">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 rounded-md border border-red-200 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50">
                    <i class="hgi-stroke hgi-delete-02"></i> Supprimer le message
                </button>
            </form>
    </div>
</x-app-layout>
