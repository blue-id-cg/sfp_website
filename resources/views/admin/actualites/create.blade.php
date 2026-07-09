<x-app-layout>
    <x-slot name="header">Nouvelle actualité</x-slot>

    <x-admin.page-header title="Nouvelle actualité" subtitle="Rédigez une publication et choisissez sa date de mise en ligne." />

    <div class="form-card max-w-3xl">
        <form method="POST" action="{{ route('admin.actualites.store') }}" enctype="multipart/form-data">
            @include('admin.actualites.form')
        </form>
    </div>
</x-app-layout>
