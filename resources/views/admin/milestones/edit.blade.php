<x-app-layout>
    <x-slot name="header">Modifier l'étape</x-slot>

    <x-admin.page-header title="Modifier l'étape" subtitle="{{ $milestone->title }}" />

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
