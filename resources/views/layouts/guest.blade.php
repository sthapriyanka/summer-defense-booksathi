<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="min-h-screen relative flex items-center justify-center p-6">
        {{-- Book Background Image --}}
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image: url('https://images.unsplash.com/photo-1616330682546-2468b2d8dd17?q=80&w=2076&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
        </div>

        <div class="absolute inset-0 bg-gradient-to-br "></div>

        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')">
            </div>
        </div>

        {{ $slot }}
    </div>
    @livewireScriptConfig
</body>

</html>
