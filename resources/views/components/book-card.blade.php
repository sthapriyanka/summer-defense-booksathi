@props(['book'])

<div id="{{ $book->id }}-book-card"
    class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden group">
    <div class="relative">
        <img src={{ $book->image }} alt={{ $book->title }}
            class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300" />
        <div class="absolute top-4 right-4 z-20">
             <button
                class="bg-white/90 hover:bg-white p-2 rounded-full shadow-lg transition-all duration-300 hover:scale-110">
                @if ($book->wishlisted)
                    <x-icon icon="heart" class="w-5 h-5 text-red-500"
                        wire:click="toggleWishlist('remove', {{ $book->id }})" />
                @else
                    <x-icon icon="heart" class="w-5 h-5 text-gray-600 hover:text-red-500"
                        wire:click="toggleWishlist('add', {{ $book->id }})" />
                @endif
            </button>
        </div>
        @if (!$book->isAvailable)
            <div class="absolute inset-0 bg-black/50 flex items-center justify-center z-10">
                <span class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold">
                    Out of Stock
                </span>
            </div>
        @endif
    </div>

    <div class="p-6">
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm text-green-600 font-medium">{{ $book->author }}</span>
            <div class="flex items-center text-yellow-500">
                <x-icon icon="star" class="w-4 h-4 fill-current" />
                <span class="text-sm text-gray-600 ml-1">{{ $book->rating }}</span>
            </div>
        </div>

        <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-1">{{ $book->title }}</h3>
        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $book->description }}</p>

        <div class="flex items-center flex-col gap-2 justify-between">
            <div class="text-2xl font-bold text-green-600">
                Rs. {{ $book->rental_price_per_week }} <span class="text-sm text-gray-500 font-normal">/week</span>
            </div>

            <div class="flex justify-between items-center gap-5">
                <a href="{{ route('books.detail', ['id' => $book->id]) }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                    Details
                </a>
                @if ($book->isAvailable)
                    <button wire:click="handleAddToCart({{ $book->id }})" class="flex-1 py-3 px-6 rounded-lg font-semibold transition-all duration-300 transform flex items-center justify-center space-x-2
                                    {{ $book->addedToCart ? 'bg-green-600 cursor-default hover:bg-green-600 scale-100' : 'bg-blue-600 hover:bg-blue-700 cursor-pointer hover:scale-105' }}
                                                text-white" {{ $book->addedToCart ? 'disabled' : '' }}>
                        <x-icon icon="{{ $book->addedToCart ? 'check-circle' : 'book-open' }}" class="w-5 h-5" />
                        <span>{{ $book->addedToCart ? 'Added to Cart' : 'Add to Cart' }}</span>
                    </button>
                @else
                    <button class="bg-gray-400 text-white px-4 py-2 rounded-lg font-medium cursor-not-allowed" disabled>
                        Notify Me
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>