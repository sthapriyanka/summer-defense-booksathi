<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-50">
    <Header>

    <div class="container mx-auto px-6 py-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">My Rented Books</h1>
            <p class="text-gray-600">Manage your current book rentals and view rental history</p>
        </div>

            {{-- Rental Summary Section --}}
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-100 p-3 rounded-full">
                        <x-icon icon="book-open" class="w-6 h-6 text-green-600" outline />
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $activeBookCount }}</p>
                        <p class="text-gray-600">Active Rentals</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center space-x-3">
                    <div class="bg-red-100 p-3 rounded-full">
                        <x-icon icon="exclamation-triangle" class="w-6 h-6 text-red-600" outline />
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $overdueBookCount }}</p>
                        <p class="text-gray-600">Overdue Books</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-100 p-3 rounded-full">
                        <x-icon icon="calendar" class="w-6 h-6 text-blue-600" outline />
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $rentedBookCount }}</p>
                        <p class="text-gray-600">Total Rentals</p>
                    </div>
                </div>
            </div>
        </div>

        <x-tab selected="Current Rentals">
    <x-tab.items tab="Current Rentals">
        <x-slot:left>
            <x-icon name="book-open" class="w-5 h-5" />
        </x-slot:left>
        @include('livewire.user.rentals.current-rental')
    </x-tab.items>
    <x-tab.items tab="Rental History">
        <x-slot:left>
            <x-icon name="clock" class="w-5 h-5" />
        </x-slot:left>
        @include('livewire.user.rentals.rental-history')
    </x-tab.items>
</x-tab>
        
    </div>
   

    <!-- Success Message Toast -->
    @if (session()->has('message'))
        <div class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-up">
            <div class="flex items-center space-x-2">
                <x-icon icon="check-circle" class="w-5 h-5" />
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif
</div>


