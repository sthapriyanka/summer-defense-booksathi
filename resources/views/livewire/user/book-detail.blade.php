<div class="container mx-auto px-6 py-8">
    <div class="grid lg:grid-cols-3 gap-8 items-stretch">
        {{-- Book Image --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24">
                <div class="aspect-[2/3] w-full overflow-hidden rounded-xl">
                    <img src="{{ $book->image }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
                </div>
                {{-- Availability Status --}}
                <div class="mt-6 p-4 bg-white rounded-xl shadow-lg">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-gray-700 font-medium">Availability</span>
                        <span
                            class="px-3 py-1 rounded-full text-sm font-medium {{ $book->isAvailable ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $this->book->available_copies }}
                            {{ $this->book->isAvailable ? 'Available' : 'Out of Stock' }}
                        </span>
                    </div>
                    <div class="text-sm text-gray-600">
                        {{ $this->book->available_copies }} of {{ $this->book->total_copies }} copies available
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                        <div class="bg-green-600 h-2 rounded-full"
                            style="width: {{ $book->total_copies ? (($book->available_copies / $book->total_copies) * 100) : 0 }}%; }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="lg:col-span-2 col-span-2">
            {{-- Book Info --}}
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <div class="mb-6">
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                    <p class="text-xl text-blue-600 font-medium mb-4">by {{ $book->author }}</p>

                    <div class="flex items-center space-x-6 mb-6">
                        <div class="flex items-center">
                            <div class="flex text-yellow-400 mr-2">
                                <x-rating rate="{{ $book->rating }}" static color="yellow" />
                            </div>
                            <span class="text-lg font-semibold text-gray-900">{{ $book['rating'] }}</span>
                            <span class="text-gray-600 ml-2">({{ count($book['reviews']) }} reviews)</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        <div class="flex items-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802" />
                            </svg>
                            <span>{{ $book->language }}</span>
                        </div>

                        <div class="flex items-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            <span>{{ $book->pages }} pages</span>
                        </div>

                        <div class="flex items-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 2v4M8 2v4M3 10h18" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($book->publication_date)->format('Y-M-d') }}</span>
                        </div>

                        {{-- <div class="flex items-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2" />
                            </svg>
                            <span>~5 hours</span>
                        </div> --}}

                    </div>

                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach ($book->genres as $genre)
                            {{ $genre->name }}
                            <x-icon icon="{{ $genre->icon  }}" class="w-5 h-5 mr-2" />
                        @endforeach
                    </div>
                </div>

                {{-- Rental Options --}}
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Rental Options</h3>
                    <div class="bg-gray-50 rounded-xl p-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Rental Duration
                                </label>
                                <select wire:model.live.debounce.300ms='rentalDuration'>
                                    <option value="1">1 Week</option>
                                    <option value="2">2 Weeks</option>
                                    <option value="3">3 Weeks</option>
                                    <option value="4">4 Weeks</option>
                                </select>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-700 mb-2">Total Cost</div>
                                <div class="text-3xl font-bold text-green-600">
                                    {{ 'Rs' . number_format($book->rental_price_per_week, 2) * $rentalDuration}}
                                </div>
                                Rs.{{ number_format($book->rental_price_per_week, 2) }} per week
                                <div class="text-sm text-gray-600">
                                </div>

                            </div>
                        </div>

                        <div class="mt-6 flex flex-col sm:flex-row gap-4">
                            @if ($book['isAvailable'])
                                <button wire:click="handleAddToCart({{ $book->id }})" class="flex-1 py-3 px-6 rounded-lg font-semibold transition-all duration-300 transform flex items-center justify-center space-x-2
                                                        {{ $this->addedToCart ? 'bg-green-600 cursor-default hover:bg-green-600 scale-100' : 'bg-blue-600 hover:bg-blue-700 cursor-pointer hover:scale-105' }}
                                                        text-white" {{ $this->addedToCart ? 'disabled' : '' }}>
                                    <x-icon icon="{{ $this->addedToCart ? 'check-circle' : 'book-open' }}"
                                        class="w-5 h-5" />
                                    <span>{{ $this->addedToCart ? 'Added to Cart' : 'Add to Cart' }}</span>
                                </button>
                            @else
                                <button
                                    class="flex-1 bg-gray-400 text-white py-3 px-6 rounded-lg font-semibold cursor-not-allowed">
                                    Notify When Available
                                </button>
                            @endif
                            <button wire:click="toggleWishlist('add', {{ $book->id }})"
                                class="border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 flex items-center justify-center space-x-2">
                                <x-icon icon="heart" class="w-5 h-5" />
                                <span>Add to Wishlist</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <x-tab selected="Description">
                <x-tab.items tab="Description">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">About This Book</h3>
                        <p class="text-gray-700 leading-relaxed text-lg">{{ $book['description'] }}</p>
                    </div>
                </x-tab.items>
                <x-tab.items tab="Details">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Book Details</h3>
                        <div class="grid md:grid-cols-2 gap-4 ">
                            <div>
                                <div class="space-y-3">
                                    <div class="flex gap-4">
                                        <span class="font-medium w-40 text-gray-700">ISBN:</span>
                                        <span class="text-gray-900">{{ $book->isbn }}</span>
                                    </div>
                                    <div class="flex gap-4">
                                        <span class="font-medium w-40 text-gray-700">Publisher:</span>
                                        <span class="text-gray-900">{{ $book->publisher }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="font-medium text-gray-700">Publication Date:</span>
                                        <span
                                            class="text-gray-900">{{ \Carbon\Carbon::parse($book->publication_date)->format('Y-M-d') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="space-y-3">
                                    <div class="flex gap-5">
                                        <span class="font-medium text-gray-700">Language:</span>
                                        <span class="text-gray-900">{{ $book->language }}</span>
                                    </div>
                                    <div class="flex gap-11">
                                        <span class="font-medium text-gray-700">Pages:</span>
                                        <span class="text-gray-900">{{ $book->pages }}</span>
                                    </div>
                                    <div class="flex gap-11">
                                        <span class="font-medium text-gray-700">Genre:</span>
                                        <span
                                            class="text-gray-900">{{ join(', ', $book->genres->pluck('name')->toArray()) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-tab.items>
                <x-tab.items tab="Reviews">
                    <div>
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Customer Reviews</h3>
                            <div class="flex items-center space-x-2">
                                <x-rating :rate="$book->rating" static color="yellow" />
                                <span class="text-lg font-semibold">{{ $book['rating'] }}</span>
                                <span class="text-gray-600">({{ $book['totalReviews'] }} reviews)</span>
                            </div>
                        </div>

                        {{-- Review Form --}}

                        @if (!$reviewAdded)
                            <form wire:submit='submitReview' class="bg-gray-50 rounded-xl p-6 mb-8">
                                <h4 class="text-lg font-semibold text-gray-900 mb-4">Write a Review</h4>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                    <div class="flex space-x-1">
                                        <x-rating wire:model='bookRating' color="yellow" />
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Comment</label>
                                    <textarea wire:model='comment' rows="4"
                                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Share your thoughts about this book..."></textarea>
                                </div>
                                <button wire:loading.attr='disabled' wire:target='submitReview' type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg font-medium transition-colors">
                                    Submit Review
                                </button>
                            </form>
                        @endif

                        {{-- Reviews List --}}
                        <div class="space-y-6">
                            @foreach ($book->reviews as $review)
                                <div key={review.id}
                                    class="border-b border-gray-200 pb-4 p-2 {{ $review->user->id === Auth::id() ? 'bg-gray-50' : '' }}">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center space-x-3">

                                            <img src="{{ $review->user->profilePicture() }}" alt="User avatar"
                                                class="w-10 h-10 rounded-full" />
                                            <div>
                                                <div class="font-medium text-gray-900">{{ $review->user->name }}
                                                </div>
                                                <div class="text-sm text-gray-600">{{ $review->created_at }}</div>
                                            </div>
                                        </div>
                                        <x-rating :rate="$review->rating" static color="yellow" />

                                    </div>
                                    <p class="text-gray-700">{{ $review->comment }}</p>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </x-tab.items>
            </x-tab>
        </div>
    </div>
</div>