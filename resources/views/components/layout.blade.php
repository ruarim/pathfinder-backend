<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Laravel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <x-nav />
      <body>
        <main class="mx-auto max-w-7xl px-6 lg:px-8 py-6 lg:py-8">
        {{ $slot }}
        </main>
      </body>
    </head>
</html>
