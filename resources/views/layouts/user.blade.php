<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Book Sathi' }}</title>
    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <x-toast />
    <x-dialog />
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
        <livewire:layout.user.header />
        {{ $slot }}
    </div>

    @stack('scripts')
    @livewireScriptConfig
</body>

</html>