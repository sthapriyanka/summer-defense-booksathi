<div class="min-h-screen bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Checkout</h1>
            <p class="text-gray-600">Ready to wrap it up? Complete your purchase now!</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Column - Forms -->
            <div class="space-y-6">
                <!-- Contact Details -->
                <x-card header="Contact Details">
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <x-input label="Full Name *" icon="users" wire:model="name" />
                            </div>
                            <x-input label="E-mail *" icon="envelope" wire:model="email" />
                            <x-input label="Phone Number *" placeholder="+1 (555) 123-4567" icon="phone" wire:model="phone" />
                        </div>
                    </div>
                </x-card>

                <!-- Shipping Address -->
                <x-card header="Shipping Address">
                    <x-radio>
                        <x-slot:label>Arrange for Delivery</x-slot:label>
                    </x-radio>

                    <x-radio>
                        <x-slot:label start>Pick up from Store</x-slot:label>
                    </x-radio>
                </x-card>

                <!-- Payment Options -->
                <x-card header="Payment Options">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @foreach([
                            ['value' => 'cash', 'label' => 'Cash on Delivery', 'svg' => 'cash'],
                            ['value' => 'card', 'label' => 'Credit/Debit Card', 'svg' => 'card'],
                            ['value' => 'connectIPS', 'label' => 'Connect IPS', 'svg' => 'bank'],
                        ] as $option)
                            <div
                                wire:click="$set('payment_method', '{{ $option['value'] }}')"
                                class="cursor-pointer border rounded-lg p-4 flex flex-col items-center text-center transition-all duration-200
                                    {{ $payment_method === $option['value'] ? 'border-blue-500 bg-blue-50' : 'border-gray-300' }}"
                            >
                                {{-- SVG icon --}}
                                @if ($option['svg'] === 'card')
                                    <svg class="h-8 w-8 text-blue-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8h18M3 12h18M5 16h4" />
                                    </svg>
                                @elseif ($option['svg'] === 'bank')
                                    <svg class="h-8 w-8 text-green-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M4 6l8-4 8 4M4 22h16M10 22V10M14 22V10" />
                                    </svg>
                                @elseif ($option['svg'] === 'cash')
                                    <svg class="h-8 w-8 text-yellow-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H9a2 2 0 00-2 2v2M7 10h10M7 14h10M7 18h10" />
                                    </svg>
                                @endif
                                <span class="font-medium">{{ $option['label'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Payment Details -->
                    @if ($payment_method === 'card')
                        <div class="space-y-4 pt-4">
                            <x-input id="cardNumber" label="Card Number" placeholder="1234 5678 9012 3456" wire:model="cardNumber" />
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <x-input id="expiry" label="Expiry Date" placeholder="MM/YY" wire:model="expiry" />
                                <x-input id="cvv" label="CVV" placeholder="123" wire:model="cvv" />
                            </div>
                            <x-input id="cardName" label="Name on Card" placeholder="John Doe" wire:model="cardName" />
                        </div>
                    @elseif ($payment_method === 'connectIPS')
                        <div class="p-4 bg-blue-50 rounded-lg text-blue-900">
                            <p>You will be redirected to the Connect IPS payment gateway after placing the order.</p>
                        </div>
                    @elseif ($payment_method === 'cash')
                        <div class="p-4 bg-green-50 rounded-lg text-green-900">
                            <p>Cash on Delivery selected. Please have the exact amount ready at delivery.</p>
                        </div>
                    @endif
                </x-card>
            </div>

            <!-- Right Column - Order Summary and Policies -->
            <div class="space-y-6">
                <!-- Order Summary -->
                <x-card header="Order Summary ({{ count($selectedItems) }} items)">
                    <div class="space-y-4">
                        @foreach ($cartItems as $cart)
                            <div class="flex flex-wrap items-start gap-4 p-4">
                                <!-- Book Image -->
                                <img src="{{ $cart->book->image }}" alt="{{ $cart->book->title }}" class="w-16 h-20 object-cover rounded-md shadow-sm" />

                                <div class="flex-1">
                                    <!-- Book Title and Author -->
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="text-md font-semibold text-gray-900">{{ $cart->book->title }}</h3>
                                            <p class="text-sm text-gray-500">{{ $cart->book->author }}</p>
                                        </div>
                                        <div class="font-medium text-gray-900 dark:text-white">
                                            Rs. {{ number_format($cart->total_price, 2) }}
                                        </div>
                                    </div>

                                    <!-- Rental Duration -->
                                    <div class="flex flex-wrap justify-between items-center gap-2">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-gray-600">Rental Duration:</span>
                                            <span class="font-medium text-gray-800">{{ $cart->rental_duration_in_weeks }} weeks</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex justify-between text-xl font-bold">
                                <span>Total</span>
                                <span class="text-green-600">Rs. {{ number_format($this->calculateTotal(), 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-4">
                        <button wire:click="placeOrder"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                            <span>Place Order</span>
                            {{-- <x-icon icon="arrow-right" class="w-5 h-5" /> --}}
                        </button>
                        {{-- 
                        <a href="/books"
                            class="w-full border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white py-3 px-6 rounded-lg font-semibold transition-all duration-300 text-center block">
                            Continue Shopping
                        </a> 
                        --}}
                    </div>
                </x-card>

                <!-- Policy Info -->
                <x-card header="Policy">
                    <div class="p-4 bg-green-50 rounded-lg">
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
                </x-card>
            </div>
        </div>
    </div>
</div>
