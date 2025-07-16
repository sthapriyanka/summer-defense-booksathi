<div>
    <div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Explore Books</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($books as $book)
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $book->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2">ISBN: {{ $book->isbn }}</p>
                    <p class="text-sm text-gray-700 mb-2 line-clamp-3">{{ $book->description }}</p>
                    <p class="text-sm text-blue-600 font-medium">Rs. {{ number_format($book->rental_price_per_week, 2) }}/week</p>
                    <p class="text-xs mt-2 text-gray-500">Lang: {{ $book->language }} | Pages: {{ $book->pages }}</p>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No books available right now.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $books->links() }}
    </div>
</div>

</div>
