<x-app-layout>
    <x-slot name="header">Pages</x-slot>

    <x-admin.page-header title="Pages" subtitle="Textes des pages publiques (accueil, à propos, métiers, HSE, équipements)." />

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($pages as $page)
            <a href="{{ route('admin.pages.edit', $page) }}" class="group flex items-center justify-between rounded-xl border border-gray-100 bg-white p-4 shadow-sm transition hover:shadow-md">
                <span class="font-medium text-gray-900">{{ $labels[$page->slug] ?? $page->slug }}</span>
                <i class="hgi-stroke hgi-arrow-right-01 text-gray-400 transition group-hover:translate-x-0.5"></i>
            </a>
        @endforeach
    </div>
</x-app-layout>
