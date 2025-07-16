<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <x-toast />
    <x-dialog />
    <div class="min-h-screen flex" x-data>
        <!-- Sidebar -->
        <livewire:layout.sidebar />

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden transition-all"
            :class="$store.sidebar.collapsed ? 'md:ml-0' : 'ml-64'">
            <livewire:layout.navbar />

            <!-- Page Content -->
            <main class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-50 p-6">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
    @livewireScriptConfig
</body>

</html>
