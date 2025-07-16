<main>
    <section
        class="relative bg-gradient-to-r from-emerald-800 via-teal-700 to-green-800 text-white py-20 overflow-hidden">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                        Discover Your Next<span class="block text-emerald-300">Great Read</span>
                    </h1>
                    <p class="text-xl text-emerald-100 leading-relaxed">
                        Rent premium books at affordable prices. Build your reading habit with our vast collection of
                        bestsellers, classics, and new releases.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a class="bg-emerald-400 hover:bg-emerald-500 text-emerald-900 px-8 py-4 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 text-center"
                            href="/books">
                            Browse Books
                        </a>
                        <a class="border-2 border-white text-white hover:bg-white hover:text-emerald-800 px-8 py-4 rounded-lg font-semibold transition-all duration-300 text-center"
                            href="/register">
                            Start Reading
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="relative">
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 shadow-2xl">
                            <div class="text-center mb-4">
                                <span
                                    class="inline-block bg-emerald-400 text-emerald-900 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                                    📚 Book of the Month
                                </span>
                            </div>
                            <div class="flex flex-col items-center">
                                <img src="{{ $this->bookOfTheMonth->image }}"
                                    alt="Fourth Wing" class="w-48 h-64 object-cover rounded-lg shadow-lg mb-4">
                                <h3 class="text-2xl font-bold text-white mb-2">{{ $this->bookOfTheMonth->title }}</h3>
                                <p class="text-emerald-200 mb-2">by {{ $this->bookOfTheMonth->author }}</p>
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="flex items-center text-emerald-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-star w-5 h-5 fill-current">
                                            <path
                                                d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z">
                                            </path>
                                        </svg>
                                        <span class="ml-1 text-white">{{ $this->bookOfTheMonth->rating }} </span>
                                    </div>
                                    <span class="text-emerald-300 font-bold text-lg">Rs.{{ $this->bookOfTheMonth->rental_price_per_week }}/week</span>
                                </div>
                                <p class="text-emerald-100 text-sm text-center mb-4 line-clamp-3">
                                    {{ $this->bookOfTheMonth->description }}
                                </p>
                                <a class="bg-emerald-400 hover:bg-emerald-500 text-emerald-900 px-6 py-2 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105"
                                    href="{{ route('books.detail', ['id' => $this->bookOfTheMonth->id]) }}">
                                    Rent Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Books --}}
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Books</h2>
                <p class="text-xl text-gray-600">Handpicked selections just for you</p>
            </div>
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($this->featuredBooks as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- New Arrival --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">New Arrivals</h2>
                    <p class="text-xl text-gray-600">Fresh additions to our collection</p>
                </div>
                <a href="/books?filter=new"
                    class="text-green-600 hover:text-green-800 font-semibold flex items-center gap-2 transition-colors">
                    View All
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($this->newArrivals as $book)
                    <x-book-card :book="$book" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Genres Section --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Browse by Genre</h2>
                <p class="text-xl text-gray-600">Find your favorite genre</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($this->genresWithCounts as $genre)
                    <x-genre-card :genre="$genre" />
                @endforeach
            </div>
        </div>
    </section>

    <livewire:layout.user.footer />
</main>
