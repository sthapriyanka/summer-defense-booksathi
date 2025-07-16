<div>
    <!-- Header with Add Button -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Order Management</h1>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="relative">
            <input wire:model.live.debounce.300ms="search" type="text"
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Search order by order number...">
            <div class="absolute left-3 top-3.5">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Order Table -->
    <div class="bg-white rounded-lg shadow overflow-y-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th wire:click="sortBy('order_number')"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                        Order Number
                        @if ($sortField === 'order_number')
                            @if ($sortDirection === 'asc')
                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                                    </path>
                                </svg>
                            @else
                                <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            @endif
                        @endif
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                        Book Title
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                        Price/Week
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                        Rental Duration
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                        Ordered By
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                        Order Date
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Order Status 1
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($orderItems as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->order->order_number ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $item->book->title ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                            Rs. {{ number_format($item->total_price, 2) }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->rental_duration_weeks ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->order->user->name ?? 'N/A' }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->order->created_at ? $item->order->created_at->format('Y-m-d') : 'N/A' }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @php
                                $status = strtolower($item->order->status ?? 'pending');
                                $badgeClasses = match ($status) {
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    default => 'bg-yellow-100 text-yellow-800',
                                };
                            @endphp
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $badgeClasses }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                @if ($status === 'pending')
                                    <button wire:click="approveOrder({{ $item->order->id }})"
                                        class="text-green-600 hover:text-green-900" title="Confirm Order">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>

                                    <button wire:click="rejectOrder({{ $item->order->id }})"
                                        onclick="return confirm('Are you sure you want to reject this order?')"
                                        class="text-red-600 hover:text-red-900" title="Reject Order">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No order found.
                        </td>
                    </tr>
                @endforelse


            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $orderItems->links() }}
    </div>

    @include('livewire.admin.payment-modal',['paymentModal' => $paymentModal])

</div>
