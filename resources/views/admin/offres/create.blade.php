<x-app-layout>
    <x-slot name="header">Nouvelle offre</x-slot>

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-3xl">
        <form method="POST" action="{{ route('admin.offres.store') }}">
            @include('admin.offres.form')
        </form>
    </div>
</x-app-layout>
