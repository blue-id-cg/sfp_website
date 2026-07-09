<x-app-layout>
    <x-slot name="header">Nouvelle offre</x-slot>

    <x-admin.page-header title="Nouvelle offre" subtitle="Publiez une offre d'emploi visible sur l'espace carrières." />

    <div class="form-card max-w-3xl">
        <form method="POST" action="{{ route('admin.offres.store') }}">
            @include('admin.offres.form')
        </form>
    </div>
</x-app-layout>
