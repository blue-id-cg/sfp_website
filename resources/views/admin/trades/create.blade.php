<x-app-layout>
    <x-slot name="header">Nouveau métier</x-slot>

    <x-admin.page-header title="Nouveau métier" subtitle="Ajoutez une discipline à la page « Nos métiers »." />

    <div class="form-card max-w-3xl">
        <form method="POST" action="{{ route('admin.trades.store') }}">
            @include('admin.trades.form')
        </form>
    </div>
</x-app-layout>
