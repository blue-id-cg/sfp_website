<x-app-layout>
    <x-slot name="header">Modifier l'offre</x-slot>

    <x-admin.page-header title="Modifier l'offre" subtitle="{{ $offre->title }}" />

    <div class="form-card max-w-3xl">
        <form method="POST" action="{{ route('admin.offres.update', $offre) }}">
            @method('PUT')
            @include('admin.offres.form')
        </form>
    </div>
</x-app-layout>
