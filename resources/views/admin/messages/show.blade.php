<x-app-layout>
    <x-slot name="header">Message de {{ $message->name }}</x-slot>

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl space-y-4">
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
            <div>
                <dt class="text-gray-500">Nom</dt>
                <dd class="text-gray-900">{{ $message->name }}</dd>
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
            <div>
                <dt class="text-gray-500">Reçu le</dt>
                <dd class="text-gray-900">{{ $message->created_at->format('d/m/Y H:i') }}</dd>
            </div>
        </dl>

        <div>
            <dt class="text-gray-500 text-sm mb-1">Message</dt>
            <dd class="text-gray-900 whitespace-pre-line">{{ $message->message }}</dd>
        </div>

        <div class="flex items-center gap-3 pt-4">
            <a href="{{ route('admin.messages.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Retour</a>
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Supprimer ce message ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-sm text-red-600 hover:underline">Supprimer</button>
            </form>
        </div>
    </div>
</x-app-layout>
