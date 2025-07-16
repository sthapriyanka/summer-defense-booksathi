<div>


    @if ($rentedBookCount === 0)
        <div class="text-center py-16">
            <x-icon icon="book-open" class="w-24 h-24 text-gray-300 mx-auto mb-4" outline />
            <h3 class="text-2xl font-bold text-gray-900 mb-2">No Rented Books</h3>
            <p class="text-gray-600 mb-6">You haven't rented any books yet.</p>
            <a href="/books"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors inline-flex items-center space-x-2">

                <x-icon icon="book-open" class="w-5 h-5" outline />
                <span>Browse Books</span>
            </a>
        </div>
    @else
        {{-- Overdue Books --}}
        @if (count($this->overdueBooks))
            <div class="mb-8">
                <div class="bg-red-50 border border-red-200 rounded-xl p-6 mb-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <x-icon icon="exclamation-triangle" class="w-6 h-6 text-red-600" />
                        <h2 class="text-2xl font-bold text-red-800">Overdue Books</h2>
                    </div>
                    <p class="text-red-700 mb-6">The following books are past their due date. Please return them or
                        extend the rental to avoid late fees.</p>

                    <div class="grid gap-6">
                        @foreach ($this->overdueBooks as $book)
                            <div key={{ $book['id'] }}
                                class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-red-500">
                                <div
                                    class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-6">
                                    <img src={{ $book['coverImage'] }} alt={{ $book['title'] }}
                                        class="w-20 h-25 object-cover rounded-lg" />
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $book['title'] }}</h3>
                                        <p class="text-gray-600 mb-2">by {{ $book['author'] }}</p>
                                        <div class="flex flex-wrap items-center gap-4 text-sm">
                                            <div class="flex items-center text-gray-600">
                                                <x-icon icon="calendar" class="w-4 h-4 mr-1" />
                                                <span>Due: {{ $book['dueDate'] }}</span>
                                            </div>
                                            <div class="flex items-center text-red-600 font-medium">
                                                <x-icon icon="clock" class="w-4 h-4 mr-1" />
                                                <span>{{ $book['daysOverdue'] }} days overdue</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col sm:flex-row gap-3">
                                        <button wire:click='openLateFeeModal({{ $book['id'] }})'
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                                            <span>Pay Late Fee</span>
                                        </button>
                                        <button disabled
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                            Extend Rental
                                        </button>
                                        <button disabled
                                            class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                                            Return Book
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-4 p-3 bg-red-100 rounded-lg border border-red-200">
                                    <p class="text-red-800 text-sm font-medium">⚠️ You must pay the late fee before you
                                        can return this book or extend the rental.</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- Active Rentals Section --}}
        @if (count($this->activeBooks))
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Active Rentals</h2>
                <div class="grid gap-6">
                    @foreach ($this->activeBooks as $book)
                        <div key={book.id} class="bg-white rounded-xl shadow-lg p-6">
                            <div class="flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-6">
                                <img src={{ $book['coverImage'] }} alt={{ $book['title'] }}
                                    class="w-20 h-25 object-cover rounded-lg" />
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $book['title'] }}</h3>
                                    <p class="text-gray-600 mb-2">by {{ $book['author'] }}</p>
                                    <div class="flex flex-wrap items-center gap-4 text-sm">
                                        <div class="flex items-center text-gray-600">
                                            <x-icon icon="calendar" class="w-4 h-4 mr-1" />
                                            <span>Rented: {{ $book['rentedDate'] }}</span>
                                        </div>
                                        <div class="flex items-center text-gray-600">
                                            <x-icon icon="clock" class="w-4 h-4 mr-1" />
                                            <span>Due: {{ $book['dueDate'] }}</span>
                                        </div>
                                        <div
                                            class="flex items-center font-medium {{ $book['daysLeft'] <= 3 ? 'text-orange-600' : 'text-green-600' }}">
                                            <x-icon icon="exclamation-triangle" class="w-4 h-4 mr-1" />
                                            <span>{{ $book['daysLeft'] }} days left</span>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-600">
                                        <span>Rental period: {{ $book['rentalWeeks'] }} weeks •
                                            Rs.{{ $book['weeklyPrice'] }}/week</span>
                                    </div>
                                </div>
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <button wire:click="openExtendModal({{ $book['id'] }})"
                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                        Extend Rental
                                    </button>
                                    <button wire:click="returnBook({{ $book['id'] }})"
                                        class="border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                                        Return Book
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endif

    <x-modal wire="showExtendModal" center>
        <x-slot:title>
            <div class="flex flex-col space-y-1.5 text-center sm:text-left">
                <h2 class="text-lg font-semibold leading-none tracking-tight flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-calendar w-5 h-5 text-green-500"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M8 2v4" />
                        <path d="M16 2v4" />
                        <rect width="18" height="18" x="3" y="4" rx="2" />
                        <path d="M3 10h18" />
                    </svg>
                    <span>Extend Rental</span>
                </h2>
            </div>
        </x-slot:title>

        <div class="space-y-6">
            <div class="flex space-x-3">
                <img src="{{ $selectedRentalId ? \App\Models\Rental::find($selectedRentalId)->book->image ?? 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=200&h=250&fit=crop' : '#' }}"
                    alt="Book Cover" class="w-16 h-20 object-cover rounded-lg">
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-900">
                        {{ $selectedRentalId ? \App\Models\Rental::find($selectedRentalId)->book->title : '' }}
                    </h3>
                    <p class="text-gray-600 text-sm">
                        by {{ $selectedRentalId ? \App\Models\Rental::find($selectedRentalId)->book->author : '' }}
                    </p>
                    <p class="text-gray-600 text-sm">
                        Rs.
                        {{ $selectedRentalId ? \App\Models\Rental::find($selectedRentalId)->book->rental_price_per_week : '' }}/week
                    </p>
                </div>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                <h4 class="font-semibold text-green-800 mb-3">Extension Details</h4>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-green-700 mb-2">Extension Period</label>
                    <div class="flex items-center space-x-3">
                        <button type="button" wire:click="updateExtensionWeeks({{ $extensionWeeks - 1 }})"
                            class="bg-green-200 hover:bg-green-300 text-green-700 w-8 h-8 rounded-full flex items-center justify-center transition-colors"
                            @disabled($extensionWeeks <= 1)>
                            <svg class="lucide lucide-minus w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 12h14" />
                            </svg>
                        </button>

                        <span class="w-20 text-center font-medium">{{ $extensionWeeks }}
                            week{{ $extensionWeeks > 1 ? 's' : '' }}</span>

                        <button type="button" wire:click="updateExtensionWeeks({{ $extensionWeeks + 1 }})"
                            class="bg-green-200 hover:bg-green-300 text-green-700 w-8 h-8 rounded-full flex items-center justify-center transition-colors">
                            <svg class="lucide lucide-plus w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-green-700">Current Due Date:</span>
                        <span
                            class="font-medium">{{ \Carbon\Carbon::parse($currentDueDate)->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-green-700">New Due Date:</span>
                        <span class="font-medium">{{ \Carbon\Carbon::parse($newDueDate)->format('M d, Y') }}</span>
                    </div>
                    <div class="border-t border-green-200 pt-2 mt-2">
                        <div class="flex justify-between">
                            <span class="text-green-800 font-semibold">Extension Cost:</span>
                            <span class="font-bold text-lg">Rs. {{ number_format($extensionCost, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex space-x-3 pt-4">
                <button type="button" wire:click="cancelExtension"
                    class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-lg font-medium transition-colors">
                    Cancel
                </button>
                <button type="button" wire:click="confirmExtension"
                    class="flex-1 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                    <svg class="lucide lucide-credit-card w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <rect width="20" height="14" x="2" y="5" rx="2" />
                        <line x1="2" x2="22" y1="10" y2="10" />
                    </svg>
                    <span>Pay Rs. {{ number_format($extensionCost, 2) }}</span>
                </button>
            </div>
        </div>

    </x-modal>

    <x-modal wire="showLateFeeModal" center>
        <div class="flex space-x-3">
            <img src="{{ $lateFeeDetails['coverImage'] }}" alt="{{ $lateFeeDetails['bookTitle'] }}"
                class="w-16 h-20 object-cover rounded-lg">
            <div class="flex-1">
                <h3 class="font-semibold text-gray-900">{{ $lateFeeDetails['bookTitle'] }}</h3>
                <p class="text-gray-600 text-sm">by {{ $lateFeeDetails['author'] }}</p>
            </div>
        </div>

        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center mb-3">
                {{-- <x-icon name="dollar-sign" class="text-red-600 mr-2" /> --}}
                <h4 class="font-semibold text-red-800">Late Fee Details</h4>
            </div>

            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-red-700">Days Overdue:</span><span
                        class="font-medium">{{ $lateFeeDetails['daysOverdue'] }} days</span></div>
                <div class="flex justify-between"><span class="text-red-700">Daily Rate:</span><span
                        class="font-medium">Rs. {{ $lateFeeDetails['lateFeePerDay'] }}/day</span></div>
                <div class="border-t border-red-200 pt-2 mt-2">
                    <div class="flex justify-between"><span class="text-red-800 font-semibold">Total Late
                            Fee:</span><span class="font-bold text-lg">Rs.
                            {{ $lateFeeDetails['totalLateFee'] }}</span></div>
                </div>
            </div>
        </div>

        <div class="flex space-x-3 pt-4">
            <button type="button" wire:click="$set('showLateFeeModal', false)"
                class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 py-2 px-4 rounded-lg font-medium transition-colors">Cancel</button>
            <button type="button" wire:click="payLateFee"
                class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                <x-icon name="credit-card" class="w-4 h-4" />
                <span>Pay Rs. {{ $lateFeeDetails['totalLateFee'] }}</span>
            </button>
        </div>

        <div class="text-xs text-gray-600 text-center">
            You must pay the late fee before you can return this book or extend the rental.
        </div>
    </x-modal>

</div>
