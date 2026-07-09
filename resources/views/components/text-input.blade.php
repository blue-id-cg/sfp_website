@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full rounded-md border border-gray-300 px-3.5 py-2.5 text-sm text-gray-900 shadow-sm transition focus:border-petrol focus:outline-none focus:ring-4 focus:ring-petrol/10']) }}>
