<div>
    <div class="container mx-auto px-6 py-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">My Orders</h1>
            <p class="text-gray-600">View and manage your book rental orders</p>
        </div>
        @if ($orderItems->isEmpty())
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <x-icon icon="book-open" class="w-24 h-24 text-gray-300 mx-auto mb-6" />
                <h2 class="text-2xl font-bold text-gray-900 mb-4">No orders found</h2>
                <p class="text-gray-600 mb-8">You haven't placed any orders yet.</p>
                <a href="/books"
                    class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 inline-flex items-center space-x-2">
                    <x-icon icon="book-open" class="w-5 h-5" />
                    <span>Browse Books</span>
                </a>
            </div>
        @else
            <!-- Order Items - Full Width -->
            <div class="w-full">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900">Order Items ({{ count($orderItems) }})</h2>
                    </div>
                    
                    <!-- Table Header -->
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-4">
                                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Book Details</h3>
                            </div>
                            <div class="col-span-2">
                                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Rental Duration</h3>
                            </div>
                            <div class="col-span-2">
                                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Order Date</h3>
                            </div>
                            <div class="col-span-2">
                                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Order Status</h3>
                            </div>
                            <div class="col-span-2">
                                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider text-right">Price/Amount</h3>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Table Body -->
                    <div class="divide-y divide-gray-200">
                        @foreach($orderItems as $order)
                            @php
                                $status = strtolower($order->order->status ?? 'pending');
                                $badgeClasses = match ($status) {
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    default => 'bg-yellow-100 text-yellow-800',
                                };
                            @endphp
                            <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <!-- Book Details -->
                                    <div class="col-span-4">
                                        <div class="flex items-center space-x-3">
                                            <img src={{ $order->book->image }} alt={{ $order->book->title }}
                                                class="w-12 h-16 object-cover rounded-lg" />
                                            <div class="flex-1">
                                                <h3 class="text-sm font-semibold text-gray-900">{{ $order->book->title }}</h3>
                                                <p class="text-xs text-gray-600">{{ $order->book->author }}</p>
                                            </div>
                                            @if ($status === 'pending')
                                                <button wire:click="cancelOrder({{ $order->order->id }})"
                                                    class="text-red-500 hover:text-red-700 p-1 transition-colors">
                                                    <x-icon icon="trash" class="w-4 h-4" />
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Rental Duration -->
                                    <div class="col-span-2">
                                        <span class="text-sm text-gray-900">
                                            {{ $order->rental_duration_weeks }} weeks
                                        </span>
                                    </div>
                                    
                                    <!-- Order Date -->
                                    <div class="col-span-2">
                                        <span class="text-sm text-gray-900">
                                            {{ $order->order->created_at ? $order->order->created_at->format('M d, Y') : 'N/A' }}
                                        </span>
                                    </div>
                                    
                                    <!-- Order Status -->
                                    <div class="col-span-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium {{ $badgeClasses }}">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </div>
                                    
                                    <!-- Price/Amount -->
                                    <div class="col-span-2 text-right">
                                        <div class="text-sm font-bold text-gray-900">
                                            Rs. {{ number_format($order->total_price, 2) }}
                                        </div>
                                        <div class="text-xs text-gray-600">
                                            Rs. {{ $order->book->rental_price_per_week }}/week
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>