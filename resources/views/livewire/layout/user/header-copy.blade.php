 {{-- <div class="flex items-center justify-between h-16">
            <a href="/" class="flex items-center space-x-2">
                <x-icon icon="book-open" class="h-8 w-8 text-blue-600" />
                <span class="text-2xl font-bold text-gray-900">BookRent</span>
            </a>

            {{-- Search Bar - Desktop --}}
        <div class="hidden md:flex flex-1 max-w-2xl mx-8">
            <div class="relative w-full">
                <input type="text" placeholder="Search books by title, author, or ISBN..." value={searchQuery}
                    onChange=""
                    class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                {{-- <Search class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" /> --}}
                <x-icon icon="magnifying-glass" class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" />
            </div>
        </div>

        {{-- Navigation - Desktop --}}
        <nav class="hidden md:flex items-center space-x-6">
            <a href="{{ route('books') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                Browse
            </a>
            <a href="/genres" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                Genres
            </a>
            <a href="/wishlist" class="relative text-gray-700 hover:text-blue-600 transition-colors">
                <x-icon icon="heart" class="h-6 w-6" />
                <span
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                    3
                </span>
            </a>
            <a href="/cart" class="relative text-gray-700 hover:text-blue-600 transition-colors">
                <x-icon icon="book-open" class="h-6 w-6" />
                <span
                    class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                    2
                </span>
            </a>
            <a href="/login"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-300 transform hover:scale-105">
                Login
            </a>
        </nav>

        {{-- Mobile Menu Button
            <button class="md:hidden text-gray-700" onClick={()=> setIsMenuOpen(!isMenuOpen)}
                >
                {isMenuOpen ?
                <X class="h-6 w-6" /> :
                <Menu class="h-6 w-6" />}
            </button> --}}
    </div> --}}
