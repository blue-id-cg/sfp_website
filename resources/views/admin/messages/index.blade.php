<x-app-layout>
    <x-slot name="header">Messages de contact</x-slot>

    @if (session('status'))
        <p class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded-md px-3 py-2">{{ session('status') }}</p>
    @endif

    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-gray-500">
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
                    <tr class="{{ $message->read_at ? '' : 'font-semibold bg-blue-50/40' }}">
                        <td class="px-4 py-3">
                            @if (! $message->read_at)
                                <span class="inline-flex rounded-full bg-blue-100 text-blue-700 px-2 py-0.5 text-xs">Non lu</span>
                            @else
                                <span class="text-gray-400 text-xs">Lu</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-gray-900">{{ $message->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $message->email }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $message->subject ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.messages.show', $message) }}" class="text-blue-600 hover:underline">Consulter</a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="inline" onsubmit="return confirm('Supprimer ce message ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Aucun message pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
</x-app-layout>
