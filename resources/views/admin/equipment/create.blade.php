<x-app-layout>
    <x-slot name="header">Nouvel équipement</x-slot>

    <x-admin.page-header title="Nouvel équipement" subtitle="Ajoutez un équipement à la page « Nos équipements »." />

    <div class="form-card max-w-3xl">
        <form method="POST" action="{{ route('admin.equipment.store') }}" enctype="multipart/form-data">
            @include('admin.equipment.form')
        </form>
    </div>
</x-app-layout>
