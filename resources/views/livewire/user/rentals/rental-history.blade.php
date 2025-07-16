<div>
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Rental History</h2>
    <div class="grid gap-6">
        @foreach ($this->rentalHistory as $rental)
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-6">
                    <img src="{{ $rental->book->image }}" alt="{{ $rental->book->title }}" class="w-20 h-25 object-cover rounded-lg">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $rental->book->title }}</h3>
                        <p class="text-gray-600 mb-2">by {{ $rental->book->author }}</p>
                        <div class="flex flex-wrap items-center gap-4 text-sm mb-2">
                            <div class="flex items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar w-4 h-4 mr-1">
                                    <path d="M8 2v4"></path>
                                    <path d="M16 2v4"></path>
                                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                    <path d="M3 10h18"></path>
                                </svg>
                                <span>Rented: {{ $rental->rented_at }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-circle-check-big w-4 h-4 mr-1">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335"></path>
                                    <path d="m9 11 3 3L22 4"></path>
                                </svg>
                                <span>Returned: {{ $rental->returned_at }}</span>
                            </div>
                            <div class="flex items-center text-green-600 font-medium">
                                <span>Total Paid: Rs. NA</span>
                            </div>
                        </div>
                        @if ($rental->myRating)
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-600">Your Rating:</span>
                                <div wire:click='viewReview({{ $rental->book->id }})'>
                                    <x-rating rate="{{ $rental->myRating }}" static color="yellow" />
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Rent Again
                        </button>
                        @if (!$rental->myRating)
                            <button wire:click='openWriteReviewModal({{ $rental->book->id }})'
                                class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                                Write Review
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<x-modal wire="reviewModal" center>
    <x-slot:title>
        <div class="flex flex-col space-y-1.5 text-center sm:text-left">
            <h2 id="radix-:r1:" class="text-lg font-semibold leading-none tracking-tight">Your Review</h2>
        </div>
    </x-slot:title>
    @if ($reviewDetail)
        <div class="space-y-4">
            <div class="flex space-x-3"><img
                    src="{{ $reviewDetail->book->image }}"
                    alt="Educated" class="w-16 h-20 object-cover rounded-lg">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">{{ $reviewDetail->book->title }}</h3>
                    <p class="text-gray-600 text-sm">by {{ $reviewDetail->book->author }}</p>
                </div>
            </div>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2"><span class="text-sm font-medium text-gray-700">Your
                            Rating:</span>
                        <x-rating rate="{{ $reviewDetail->rating }}" static color="yellow" />
                    </div>
                    <div class="flex items-center text-sm text-gray-500"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-calendar w-4 h-4 mr-1">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>
                        {{ $reviewDetail->created_at->format('M d, Y') }}
                    </div>
                </div>
                <div><label class="block text-sm font-medium text-gray-700 mb-2">Your Review:</label>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <p class="text-gray-700">{{ $reviewDetail->comment }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-modal>

<x-modal wire="writeReviewModal" persistent center>
    <x-slot:title>
        <div class="flex flex-col space-y-1.5 text-center sm:text-left">
            <h2 id="radix-:r4:" class="text-lg font-semibold leading-none tracking-tight">Write a Review</h2>
        </div>
    </x-slot:title>
    <div class="space-y-4">
        <div class="flex space-x-3">
            @if($selectedBookId)
                @php $selectedBook = \App\Models\Book::find($selectedBookId); @endphp
                <img src="{{ $selectedBook->image ?? 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=200&h=250&fit=crop' }}"
                    alt="{{ $selectedBook->title ?? 'Book Cover' }}" class="w-16 h-20 object-cover rounded-lg">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">{{ $selectedBook->title ?? 'Book Title' }}</h3>
                    <p class="text-gray-600 text-sm">by {{ $selectedBook->author ?? 'Unknown Author' }}</p>
                </div>
            @else
                <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=200&h=250&fit=crop"
                    alt="Book Cover" class="w-16 h-20 object-cover rounded-lg">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">Book Title</h3>
                    <p class="text-gray-600 text-sm">by Unknown Author</p>
                </div>
            @endif
        </div>
        <div class="@error('newRating') border border-red-500 rounded-lg p-3 bg-red-50 @enderror">
            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
            <x-rating wire:model='newRating' color="yellow" />
            @error('newRating') 
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div><label class="block text-sm font-medium text-gray-700 mb-2">Your Review <span
                    class="text-red-500">*</span></label>
            <textarea wire:model='newReview'
                class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 resize-none @error('newReview') border-red-500 @enderror"
                placeholder="Share your thoughts about this book..." rows="4"></textarea>
            @error('newReview') 
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex space-x-3 pt-4">
            <button wire:click="closeWriteReviewModal"
                class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-lg font-medium transition-colors">Cancel</button>
            <button wire:click='writeReview'
                class="flex-1 bg-green-600 hover:bg-green-700 disabled:bg-gray-400 disabled:cursor-not-allowed text-white py-2 px-4 rounded-lg font-medium transition-colors">
                Submit Review
            </button>
        </div>
    </div>
</x-modal>
