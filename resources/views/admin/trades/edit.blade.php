<x-app-layout>
    <x-slot name="header">Modifier le métier</x-slot>

    <x-admin.page-header title="Modifier le métier" subtitle="{{ $trade->title }}" />

    <div class="form-card max-w-3xl">
        <form method="POST" action="{{ route('admin.trades.update', $trade) }}">
            @method('PUT')
            @include('admin.trades.form')
        </form>
    </div>
</x-app-layout>
