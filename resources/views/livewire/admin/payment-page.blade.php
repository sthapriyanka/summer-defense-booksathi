<div>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Payments</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        {{-- Total Payments --}}
        <div class="rounded-lg border bg-white shadow-sm hover:shadow-md transition-shadow">
            <div class="p-6 flex items-center justify-between pb-2">
                <h3 class="text-sm font-medium tracking-tight">Total Payments</h3>
                <x-icon icon="currency-rupee" class="h-4 w-4 text-green-600" />
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-gray-900">₨ {{ number_format($kpis['total'], 2) }}</div>
                @if ($kpis['percent_change'] !== null)
                    <p class="text-xs text-green-600 mt-1">+{{ $kpis['percent_change'] }}% from last month</p>
                @else
                    <p class="text-xs text-gray-500 mt-1">No data from last month</p>
                @endif
            </div>
        </div>

        {{-- Checkout Payments --}}
        <div class="rounded-lg border bg-white shadow-sm hover:shadow-md transition-shadow">
            <div class="p-6 flex items-center justify-between pb-2">
                <h3 class="text-sm font-medium tracking-tight">Checkout Payments</h3>
                <x-icon icon="credit-card" class="h-4 w-4 text-blue-600" />
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-gray-900">₨ {{ number_format($kpis['types']['order'], 2) }}</div>
                <p class="text-xs text-blue-600 mt-1">
                    {{ number_format(($kpis['types']['order'] / max($kpis['total'], 1)) * 100, 1) }}% of total
                </p>
            </div>
        </div>

        {{-- Penalty Payments --}}
        <div class="rounded-lg border bg-white shadow-sm hover:shadow-md transition-shadow">
            <div class="p-6 flex items-center justify-between pb-2">
                <h3 class="text-sm font-medium tracking-tight">Penalty Payments</h3>
                <x-icon icon="exclamation-triangle" class="h-4 w-4 text-red-600" />
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-gray-900">₨ {{ number_format($kpis['types']['penalty'], 2) }}</div>
                <p class="text-xs text-red-600 mt-1">
                    {{ number_format(($kpis['types']['penalty'] / max($kpis['total'], 1)) * 100, 1) }}% of total
                </p>
            </div>
        </div>

        {{-- Extension Payments --}}
        <div class="rounded-lg border bg-white shadow-sm hover:shadow-md transition-shadow">
            <div class="p-6 flex items-center justify-between pb-2">
                <h3 class="text-sm font-medium tracking-tight">Extension Payments</h3>
                <x-icon icon="clock" class="h-4 w-4 text-purple-600" />
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-gray-900">₨ {{ number_format($kpis['types']['extension'], 2) }}
                </div>
                <p class="text-xs text-purple-600 mt-1">
                    {{ number_format(($kpis['types']['extension'] / max($kpis['total'], 1)) * 100, 1) }}% of total
                </p>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <livewire:admin.daily-income-graph />
        <livewire:admin.payment-type-pie-chart />
    </div>


    <div class="mb-6 flex gap-2 flex-wrap">
        <div class="flex items-center gap-2">
            Type:
            <div class="w-48">
                <x-select.styled wire:model.live="filters.type" class="w-40" :options="['all', 'order', 'penalty', 'extension']" required>
                </x-select.styled>
            </div>
        </div>
    </div>

    <x-table :$headers :rows="$this->list" :$sort paginate striped :target="[]" sm>
        @interact('column_id', $row)
            PAY-{{ $row->id }}
        @endinteract
        @interact('column_name', $row)
            {{ $row->user->name }}
        @endinteract
        @interact('column_type', $row)
            <x-badge text="{{ ucfirst($row->type) }}" :color="match ($row->type) {
                'order' => 'blue',
                'penalty' => 'red',
                'extension' => 'orange',
            }" light />
        @endinteract
        @interact('column_rental', $row)
            @if ($row->type == 'order')
                {{ $row->order->orderItems->count() }} items
            @elseif ($row->type == 'penalty')
                <div class="max-w-[200px] text-ellipsis overflow-hidden" title="{{ $row->rental?->book->title }}">
                    {{ $row->rental?->book->title }}
                </div>
            @elseif ($row->type == 'extension')
                <div class="max-w-[200px] text-ellipsis overflow-hidden" title="{{ $row->rental?->book->title }}">
                    {{ $row->rental?->book->title }}
                </div>
            @endif
        @endinteract
        @interact('column_paid_at', $row)
            {{ $row->paid_at->format('M d, Y') }}
        @endinteract
        @interact('column_action', $row)
            <button wire:click='showDetailModal({{ $row->id }})'
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground rounded-md h-8 w-8 p-0"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-eye h-4 w-4">
                    <path
                        d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0">
                    </path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg></button>
        @endinteract
    </x-table>

    <x-modal wire="detailModal" center>
        @if ($selectedPayment)
            <x-slot:title>
                <h2 class="text-lg font-semibold leading-none tracking-tight flex gap-2 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-dollar-sign w-5 h-5 text-green-600">
                        <line x1="12" x2="12" y1="2" y2="22"></line>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    <span>Payment Details - PAY-{{ $selectedPayment->id }}</span>
                </h2>
            </x-slot:title>
            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-user w-4 h-4 text-gray-500">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-600">Customer</p>
                            <p class="font-semibold">{{ $selectedPayment->user->name }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4 text-gray-500">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-600">Payment Date</p>
                            <p class="font-semibold">{{ $selectedPayment->paid_at->toFormattedDateString() }}</p>
                        </div>
                    </div>
                    @if ($selectedPayment->payment_method)
                        <div class="flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-credit-card w-4 h-4 text-gray-500">
                                <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                                <line x1="2" x2="22" y1="10" y2="10"></line>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-600">Payment Method</p>
                                <p class="font-semibold">{{ $selectedPayment->payment_method }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-3 flex items-center"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-book w-5 h-5 mr-2">
                            <path
                                d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20">
                            </path>
                        </svg>Books in Order</h3>
                    <div class="space-y-3">
                        @foreach ($selectedPayment->books ?? [] as $book)
                            <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg"><img
                                    src="{{ $book->image }}" alt="{{ $book->title }}"
                                    class="w-16 h-20 object-cover rounded-lg">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900">{{ $book->title }}</h4>
                                    <p class="text-gray-600 text-sm">by {{ $book->author }}</p>
                                    <div class="flex items-center space-x-1 mt-1"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-clock w-3 h-3 text-blue-500">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        @if($book->rental_duration)
                                        <p class="text-xs text-blue-600">{{ $book->rental_duration }}
                                            {{ $book->rental_duration > 1 ? 'weeks' : 'week' }}</p>
                                            @endif
                                    </div>
                                </div>
                                <div class="text-right">
                                    @if($book->price)
                                    <p class="font-semibold text-lg">Rs
                                        {{ $book->price }}</p>
                                        @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="border-t border-gray-200 pt-4">
                    <div class="flex justify-between items-center"><span class="text-lg font-semibold">Total
                            Amount:</span><span class="text-2xl font-bold text-green-600">Rs.
                            {{ $selectedPayment->total_amount }}</span></div>
                </div>
            </div>
        @endif
    </x-modal>
</div>
