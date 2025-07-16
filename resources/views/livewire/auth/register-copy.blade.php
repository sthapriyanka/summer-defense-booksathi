<div class="max-w-md mx-auto mt-20 p-6 bg-white rounded-xl shadow-md space-y-6">
    <form wire:submit.prevent="register" class="space-y-4">
        @if (session()->has('success'))
            <div class="text-green-600 text-sm">{{ session('success') }}</div>
        @endif

        <x-input label="Name *" wire:model="name" />
        <x-input label="Email *" wire:model="email" />
        <x-password label="Password *" wire:model="password" />
        <x-password label="Confirm Password *" wire:model="password_confirmation" />
        <x-button type="submit" class="w-full">Register</x-button>
    </form>

    <div class="text-sm text-center text-gray-600">
        Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Login here</a>
    </div>
</div>