<x-app-layout>
    <x-slot name="header">Modifier l'offre</x-slot>

    <div class="bg-white rounded-lg shadow-sm p-6 max-w-3xl">
        <form method="POST" action="{{ route('admin.offres.update', $offre) }}">
            @method('PUT')
            @include('admin.offres.form')
        </form>
    </div>
</x-app-layout>
