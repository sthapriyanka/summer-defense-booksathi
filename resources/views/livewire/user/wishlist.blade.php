<div class="container mx-auto px-6 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-2 flex items-center">
            <x-icon icon="heart" class="w-10 h-10 text-red-500 mr-3" outline />
            My Wishlist
        </h1>
        <p class="text-gray-600">Books you'd love to read ({{ count($this->wishlistedBooks) }} items)</p>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">

        @foreach ($this->wishlistedBooks as $book)
            <x-book-card :book="$book" />
        @endforeach
    </div>
</div>
