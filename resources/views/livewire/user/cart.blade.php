<div>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Renatal Cart</h1>
            <p class="text-gray-600">Review your selected books and proceed to checkout</p>
        </div>

        @if (count($cartItems) === 0)
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <x-icon icon="book-open" class="w-24 h-24 text-gray-300 mx-auto mb-6" />
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Your cart is empty</h2>
                <p class="text-gray-600 mb-8">Looks like you haven't added any books to your cart yet.</p>
                <a href="/books"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 inline-flex items-center space-x-2">
                    <x-icon icon="book-open" class="w-5 h-5" />
                    <span>Browse Books</span>
                </a>
            </div>
        @else
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-2xl font-bold text-gray-900">Cart Items ({{ count($cartItems) }})</h2>
                        </div>
                        <div class="divide-y divide-gray-200">
                            @foreach ($cartItems as $cart)
                                <div class="p-6">
                                    <div class="flex items-start space-x-4">
                                        <input type="checkbox" wire:model.live="selectedItems" value="{{ $cart->book_id }}" />
                                        <img src={{ $cart->book->image }} alt={{ $cart->book->title }}
                                             class="w-20 h-24 object-cover rounded-lg" />
                                        <div class="flex-1">
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-900">{{ $cart->book->title }}</h3>
                                                    <p class="text-gray-600">{{ $cart->book->author }}</p>
                                                </div>
                                                <button wire:click="removeItem({{ $cart->book_id }})"
                                                        class="text-red-500 hover:text-red-700 p-1 transition-colors">
                                                    <x-icon icon="trash" class="w-5 h-5" />
                                                </button>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center space-x-3">
                                                    <span class="text-sm text-gray-600">Rental Duration:</span>
                                                    <div class="flex items-center space-x-2">
                                                        <button wire:click="$set('quantities.{{ $cart->book_id }}', max(1, {{ $rentalDurations[$cart->book_id] ?? $cart->quantity }} - 1))"
                                                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 w-8 h-8 rounded-full flex items-center justify-center">
                                                            <x-icon icon="minus" class="w-4 h-4" />
                                                        </button>
                                                        <span class="w-16 text-center font-medium">
                                                            {{ $rentalDurations[$cart->book_id] ?? $cart->quantity }} week{{ ($rentalDurations[$cart->book_id] ?? $cart->quantity) > 1 ? 's' : '' }}
                                                        </span>
                                                        <button wire:click="$set('rentalDurations.{{ $cart->book_id }}', {{ $rentalDurations[$cart->book_id] ?? $cart->quantity }} + 1)"
                                                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 w-8 h-8 rounded-full flex items-center justify-center">
                                                            <x-icon icon="plus" class="w-4 h-4" />
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="text-right">
                                                    <div class="text-lg font-bold text-gray-900">
                                                        Rs. {{ number_format($cart->book->rental_price_per_week * $rentalDurations[$cart->book_id], 2) }}
                                                    </div>
                                                    <div class="text-sm text-gray-600">
                                                        Rs. {{ $cart->book->rental_price_per_week }}/week
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary ({{ count($selectedItems) }} items)</h2>

                        <div class="space-y-4 mb-6">
                            {{-- <div class="flex justify-between">
                                <span class="text-gray-600">Cart Subtotal</span>
                                <span class="font-semibold">Rs. {{ number_format($this->calculateCartSubtotal(), 2) }}</span>
                            </div> --}}
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-semibold">Rs. {{ number_format($this->calculateTotal(), 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Delivery Fee</span>
                                <span class="font-semibold">Rs. 0.00</span>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between text-xl font-bold">
                                    <span>Total</span>
                                    <span class="text-green-600">
                                        Rs. {{ number_format($this->calculateTotal(), 2) }}                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <button wire:click="checkout"
                               class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                                <span>Proceed to Checkout</span>
                                <x-icon icon="arrow-right" class="w-5 h-5" />
                            </button>

                            <a href="/books"
                               class="w-full border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 text-center block">
                                Continue Shopping
                            </a>
                        </div>

                        <div class="mt-6 p-4 bg-green-50 rounded-lg">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-sm font-medium text-green-800">Free returns within 7 days</span>
                            </div>
                            <p class="text-sm text-green-700 mt-1">
                                All books include our satisfaction guarantee
                            </p>
                        </div>

                        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                            <h4 class="font-semibold text-blue-900 mb-2">Rental Terms</h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li>• Books must be returned by due date</li>
                                <li>• Late fees apply after grace period</li>
                                <li>• Damage fees may apply</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
