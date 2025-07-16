<div class="p-6 bg-green-50 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <div class="text-2xl font-bold">Rental History</div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <x-card padding="p-4">
            <div class="text-gray-500">Active Rentals</div>
            <div class="text-2xl font-bold">{{$this->activeRentals}}</div>
        </x-card>
        <x-card padding="p-4">
            <div class="text-gray-500">Overdue Rentals</div>
            <div class="text-2xl font-bold">{{$this->overdueRentals}}</div>
        </x-card>
    </div>

    <x-card class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <x-input class="w-ful sm:flex-1" wire:model.live.debounce.300ms="search"
            placeholder="Search by book title, user name, or email..." icon="magnifying-glass" />
        <x-select.styled wire:model.live.debounce.300ms="statusFilter" :options="[
            '' => 'All Status',
            'rented' => 'Rented',
            'overdue' => 'Overdue',
            'returned' => 'Returned',
        ]" class="w-full sm:w-1/2" />
    </x-card>

    <div class="mt-6">
        <x-table :$headers :rows="$this->list()" :$sort paginate striped :filter="['perPage', 'search']" :quantity="[10, 25, 50]">
            @interact('column_status', $row)
                <x-badge :color="match ($row->status) {
                    'overdue' => 'red',
                    'returned' => 'yellow',
                    default => 'green',
                }">
                    {{ ucfirst($row->status) }}
                </x-badge>
            @endinteract
            @interact('column_book_title', $row)
                <div class="max-w-[200px] text-ellipsis overflow-hidden" title="{{ $row->book->title }}">
                    {{ $row->book->title }}
                </div>
            @endinteract
            @interact('column_rented_at', $row)
                {{ $row->rented_at?->format('M, d, Y') }}
            @endinteract
            @interact('column_returned_at', $row)   
                {{ $row->returned_at?->format('M, d, Y') }}
            @endinteract
            @interact('column_due_date', $row)
                {{ $row->due_date?->format('M, d, Y') }}
            @endinteract
        </x-table>
    </div>

</div>
