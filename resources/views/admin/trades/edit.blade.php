<x-app-layout>
    <x-slot name="header">Modifier le métier</x-slot>

    <x-admin.page-header title="Modifier le métier" subtitle="{{ $trade->title }}">
        <x-slot:actions>
            <a href="{{ route('metiers.show', $trade) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 rounded-md border border-gray-200 px-3 py-1.5 text-sm font-medium text-gray-700 hover:border-gray-400">
                Voir sur le site ↗
            </a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="form-card max-w-3xl">
        <form method="POST" action="{{ route('admin.trades.update', $trade) }}">
            @method('PUT')
            @include('admin.trades.form')
        </form>
    </div>
</x-app-layout>
