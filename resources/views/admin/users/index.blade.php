<x-app-layout>
    <x-slot name="header">Utilisateurs</x-slot>

    <x-admin.page-header title="Utilisateurs" subtitle="{{ $users->total() }} compte(s) ayant accès à l'administration.">
        <x-slot:actions>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                <i class="hgi-stroke hgi-add-01 text-xs"></i> Nouvel utilisateur
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-4 py-3">Nom</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Rôle</th>
                    <th class="px-4 py-3">Membre depuis</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50/60">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-[#0C0E22] text-xs font-semibold text-white">
                                    {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                                </span>
                                <span class="font-medium text-gray-900">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-gray-500">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $user->getRoleNames()->first() ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center gap-1.5 text-blue-600 hover:underline">
                                <i class="hgi-stroke hgi-edit-02 text-xs"></i> Modifier
                            </a>
                            @unless ($user->is(auth()->user()) || ($user->hasRole('admin') && $adminCount <= 1))
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" data-confirm data-confirm-title="Supprimer cet utilisateur ?" data-confirm-message="Cet utilisateur sera définitivement supprimé.">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1.5 text-red-600 hover:underline">
                                        <i class="hgi-stroke hgi-delete-02 text-xs"></i> Supprimer
                                    </button>
                                </form>
                            @endunless
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-gray-500">
                            <i class="hgi-stroke hgi-user mb-2 block text-2xl text-gray-300"></i>
                            Aucun utilisateur pour le moment.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</x-app-layout>
