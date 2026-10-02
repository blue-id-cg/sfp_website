<x-app-layout>
    <x-slot name="header">Modifier l'étape</x-slot>

    <x-admin.page-header title="Modifier l'étape" subtitle="{{ $milestone->title }}">
        <x-slot:actions>
            <a href="{{ route('about.index') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 rounded-md border border-gray-200 px-3 py-1.5 text-sm font-medium text-gray-700 hover:border-gray-400">
                Voir sur le site ↗
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="form-card max-w-lg">
        <form method="POST" action="{{ route('admin.milestones.update', $milestone) }}">
            @method('PUT')
            @include('admin.milestones.form')

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                    Enregistrer
                </button>
                <a href="{{ route('admin.milestones.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
            </div>
        </form>
    </div>
</x-app-layout>
