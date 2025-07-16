<header class="bg-white shadow-lg sticky top-0 z-40">
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-between h-16">
            <a href="/" class="flex items-center space-x-2 flex-shrink-0">
                <x-icon icon="book-open" class="h-8 w-8 text-green-600" />
                <span class="text-2xl font-bold text-green-600">Book Sathi</span>
            </a>

            @if (Auth::check())
                <nav class="hidden md:flex items-center space-x-6 ml-8">
                    <a href="/" class="text-gray-700 hover:text-green-600 transition-colors font-medium">Home</a>
                    <a href="/books" class="text-gray-700 hover:text-green-600 transition-colors font-medium">Books</a>
                    <a href="{{ route('genres') }}"
                        class="text-gray-700 hover:text-green-600 transition-colors font-medium">Genres</a>
                    <a href="/my-rentals" class="text-gray-700 hover:text-green-600 transition-colors font-medium">My
                        Rentals</a>
                         <a href="/orders" class="text-gray-700 hover:text-green-600 transition-colors font-medium">My
                        Orders</a>
                </nav>

                <div class="hidden md:flex flex-1 max-w-md mx-6">
                    <form wire:submit='searchBook' class="relative w-full flex items-center">
                        <input type="text" wire:model='search' placeholder="Search books, authors..."
                            class="w-full px-4 py-2 pl-10 pr-4 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" />
                            <button type="submit">
                                <x-icon icon="magnifying-glass" class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" />
                            </button>
                         @if($search)
                            <button type="button" wire:click="clearSearch" class="ml-2 px-3 py-1 rounded-md bg-gray-300 text-gray-700 text-sm">Clear</button>
                        @endif
                    </form>
                </div>

                <div class="flex items-center space-x-3 flex-shrink-0">
                    <a href="{{ route('wishlist') }}"
                        class="p-2 text-gray-600 hover:text-green-600 transition-colors relative">
                        <x-icon icon="heart" class="w-6 h-6" />
                        @if ($wishlistCount)
                            <span
                                class="absolute -top-1 -right-1 bg-green-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $wishlistCount }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('cart') }}"
                        class="p-2 text-gray-600 hover:text-green-600 transition-colors relative">
                        <x-icon icon="shopping-bag" class="w-6 h-6" />
                        <span
                            class="absolute -top-1 -right-1 bg-green-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    </a>
                    <a href="{{ route('profile') }}" class="p-2 text-gray-600 hover:text-green-600 transition-colors">
                        <x-icon icon="user" class="w-6 h-6" />
                    </a>
                </div>
            @else
                <div class="flex gap-2 flex-shrink-0">
                    <a href="{{ route('register') }}"
                        class="border border-green-600 hover:bg-green-700 hover:text-white text-green-600 px-6 py-2 rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                        Register
                    </a>
                    <a href="{{ route('login') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                        Login
                    </a>
                </div>
            @endif
        </div>
    </div>
</header>
