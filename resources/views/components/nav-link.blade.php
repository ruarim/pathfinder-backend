@props(['route'])

@php
    $classes = Request::routeIs($route) ? "border-indigo-500 text-gray-900": "border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700"
@endphp

<a href="{{ route($route) }}"
    class="{{ $classes }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium"
    aria-current="page">
    {{ $slot }}
</a>
