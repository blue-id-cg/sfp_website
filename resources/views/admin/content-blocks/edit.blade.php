<x-app-layout>
    <x-slot name="header">Modifier le bloc</x-slot>

    <x-admin.page-header title="Modifier le bloc" subtitle="{{ $block->title }}" />

    <div class="form-card max-w-lg">
        <form method="POST" action="{{ route('admin.content-blocks.update', $block) }}">
            @method('PUT')
            @include('admin.content-blocks.form')

            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="inline-flex items-center rounded-md bg-[#0C0E22] px-4 py-2 text-sm font-medium text-white hover:bg-black">
                    Enregistrer
                </button>
                <a href="{{ route('admin.content-blocks.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annuler</a>
            </div>
        </form>
    </div>
</x-app-layout>
