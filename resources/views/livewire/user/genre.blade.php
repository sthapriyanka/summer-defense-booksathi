<div class="container mx-auto px-6 py-8">
    <div class="text-center mb-12">
        <h1 class="text-5xl font-bold text-gray-900 mb-4">Browse Genres</h1>
        <p class="text-xl text-gray-600 mb-8">Discover books by your favorite genres</p>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($this->genresWithCount as $genre)
            <a class="group" href="/books?genre={{ $genre->name }}">
                <div
                    class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 overflow-hidden">
                    <div class="bg-{{ $genre->color }} p-6 text-white relative">
                        <div class="flex items-center justify-between mb-2">
                            <x-icon icon="{{ $genre->icon }}" class="w-8 h-8" />
                            <span class="text-sm font-medium bg-white/20 px-2 py-1 rounded-full">{{ $genre->count }}
                                books</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">{{ $genre->name }}</h3>
                        <p class="text-sm opacity-90">{{ $genre->description }}</p>
                    </div>
                    <div class="p-4">
                        <div class="text-center py-4">
                            <p class="text-sm text-gray-500">Explore {{ $genre->count }} amazing books</p>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <span
                                class="text-green-600 text-sm font-medium group-hover:text-green-700 transition-colors">
                                Browse all →
                            </span>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach


    </div>
    {{-- this is for loading the color before hand --}}
    <section>
        <div class="bg-indigo-600"></div>
        <div class="bg-rose-500"></div>
        <div class="bg-red-600"></div>
        <div class="bg-yellow-700"></div>
        <div class="bg-amber-600"></div>
        <div class="bg-cyan-600"></div>
        <div class="bg-violet-600"></div>
        <div class="bg-green-600"></div>
        <div class="bg-blue-600"></div>
        <div class="bg-stone-600"></div>
        <div class="bg-orange-700"></div>
        <div class="bg-emerald-500"></div>
        <div class="bg-purple-600"></div>
        <div class="bg-lime-600"></div>
        <div class="bg-neutral-700"></div>
        <div class="bg-sky-500"></div>
        <div class="bg-teal-600"></div>
        <div class="bg-amber-500"></div>
        <div class="bg-blue-900"></div>
        <div class="bg-red-800"></div>
        <div class="bg-yellow-500"></div>
        <div class="bg-fuchsia-600"></div>
        <div class="bg-indigo-800"></div>
        <div class="bg-rose-700"></div>
        <div class="bg-gray-500"></div>
        <div class="bg-yellow-600"></div>
        <div class="bg-orange-500"></div>
        <div class="bg-gray-700"></div>
        <div class="bg-purple-800"></div>
        <div class="bg-zinc-600"></div>
        <div class="bg-red-500"></div>
        <div class="bg-yellow-400"></div>
        <div class="bg-amber-400"></div>
        <div class="bg-green-400"></div>
        <div class="bg-rose-400"></div>
        <div class="bg-violet-500"></div>
        <div class="bg-cyan-800"></div>
        <div class="bg-slate-600"></div>
        <div class="bg-gray-700"></div>
        <div class="bg-black"></div>
        <div class="bg-blue-700"></div>
        <div class="bg-teal-500"></div>
        <div class="bg-amber-700"></div>
        <div class="bg-emerald-700"></div>
        <div class="bg-lime-700"></div>
    </section>
</div>
