<x-app-layout>
    <x-slot name="header">Message de {{ $message->name }}</x-slot>

    <x-admin.page-header title="Message de {{ $message->name }}" subtitle="Reçu le {{ $message->created_at->format('d/m/Y à H:i') }}">
        <x-slot:actions>
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                <i class="hgi-stroke hgi-arrow-left-01 text-xs"></i> Retour
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="form-card max-w-2xl space-y-5">
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <dt class="text-gray-500">Nom</dt>
                <dd class="text-gray-900 font-medium">{{ $message->name }}</dd>
            </div>
            <div>
                <dt class="text-gray-500">Email</dt>
                <dd class="text-gray-900">
                    <a href="mailto:{{ $message->email }}" class="text-blue-600 hover:underline">{{ $message->email }}</a>
                </dd>
            </div>
            @if ($message->phone)
                <div>
                    <dt class="text-gray-500">Téléphone</dt>
                    <dd class="text-gray-900">{{ $message->phone }}</dd>
                </div>
            @endif
            @if ($message->subject)
                <div>
                    <dt class="text-gray-500">Sujet</dt>
                    <dd class="text-gray-900">{{ $message->subject }}</dd>
                </div>
            @endif
        </dl>

        <div class="border-t border-gray-100 pt-4">
            <dt class="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-2">Message</dt>
            <dd class="text-gray-900 whitespace-pre-line leading-relaxed">{{ $message->message }}</dd>
        </div>

        @if ($message->cv_path)
            <div class="border-t border-gray-100 pt-4">
                <dt class="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-2">CV</dt>
                <dd>
                    <a href="{{ $message->cv_url }}" target="_blank" class="inline-flex items-center gap-2 rounded-md border border-gray-200 px-3 py-2 text-sm font-medium text-gray-700 hover:border-gray-300">
                        <i class="hgi-stroke hgi-file-01"></i> {{ $message->cv_filename }}
                    </a>
                </dd>
            </div>
        @endif

        <div class="flex items-center gap-3 border-t border-gray-100 pt-4">
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Supprimer ce message ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-1.5 text-sm text-red-600 hover:underline">
                    <i class="hgi-stroke hgi-delete-02 text-xs"></i> Supprimer
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
