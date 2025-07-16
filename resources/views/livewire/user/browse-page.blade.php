<main>

    <div class="container mx-auto px-6 py-8">
        {{-- Page Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">Browse Books</h1>
                    <p class="text-gray-600">Discover your next favorite read from our extensive collection</p>
                </div>
                @if($selectedGenre)
                    <button wire:click="$set('selectedGenre', '')"
                        class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                        <x-icon icon="x-mark" class="w-4 h-4" />
                        Clear Genre Filter
                    </button>
                @endif
            </div>
            @if($selectedGenre)
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center gap-2">
                        <x-icon icon="tag" class="w-5 h-5 text-blue-600" />
                        <span class="text-blue-800 font-medium">Filtering by genre: <span
                                class="font-bold">{{ $selectedGenre }}</span></span>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Filters Sidebar --}}
            <div class="lg:w-1/4">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <Filter class="w-5 h-5 mr-2" />
                        Filters
                    </h3>

                    {{-- Language Filter --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Language</label>
                        <select
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            wire:model.live.debounce.300ms='language'>
                            @foreach ($languageOptions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Genre Filter --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                        <select
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            wire:model.live.debounce.300ms='selectedGenre'>
                            <option value="">All Genres</option>
                            @foreach ($this->availableGenres as $genre)
                                <option value="{{ $genre->name }}">{{ $genre->name }} ({{ $genre->books_count }})</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Availability Filter --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Availability</label>
                        <select
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            wire:model.live.debounce.300ms='availability'>
                            @foreach ($availabilityOptions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Price Range --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price Range (per
                            week)</label>
                        <div class="space-y-2">
                            <input type="range" min="0" max="{{ $maxPrice }}" class="w-full"
                                wire:model.live.debounce.300ms='priceRange' />
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>Rs.0</span>
                                <span>Rs.{{ $maxPrice }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Publication Year --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Publication Year</label>
                        <select
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            wire:model.live.debounce.300ms='publicationYearRange'>
                            @foreach ($publicationYearRanges as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button wire:click="clearFilter"
                        class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg transition-colors">
                        Clear All Filters
                    </button>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="lg:w-3/4">
                {{-- Sort and View Controls --}}
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700 font-medium">Sort by:</span>
                            <select
                                class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                wire:model.live.debounce.300ms='sortBy'>
                                @foreach ($sortOptions as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center space-x-2">
                            <span class="text-gray-700 font-medium">View:</span>
                            <button wire:click="changeViewMode('grid')"
                                class="p-2 rounded-lg transition-colors {{ $viewMode == 'grid' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                <x-icon icon="table-cells" class="w-5 h-5" />
                            </button>
                            <button wire:click="changeViewMode('list')"
                                class="p-2 rounded-lg transition-colors {{ $viewMode != 'grid' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                                <x-icon icon="list-bullet" class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Results Count --}}
                <div class="mb-6">
                    <p class="text-gray-600">Showing <span class="font-semibold">{{ count($this->bookList) }}</span>
                        books
                    </p>
                </div>

                {{-- Books Grid --}}
                <div class="grid gap-6 {{ $viewMode == 'grid' ? 'md:grid-cols-2 lg:grid-cols-3' : 'grid-cols-1' }}">
                    @foreach ($this->bookList as $book)
                        <x-book-card :key="$book->id" :book="$book" />
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $this->bookList->links() }}
                </div>
            </div>
        </div>
</main>