<div>
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">User Profile</h1>
            <p class="text-gray-600 mt-1">Detailed information about {{ $user->name }}</p>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 ">
            <div class="rounded-lg border bg-white text-card-foreground shadow-sm">
                <div class="flex flex-col space-y-3 p-6 text-center">
                    <span class="relative flex shrink-0 overflow-hidden rounded-full w-20 h-20 mx-auto mb-4">
                        <img class="aspect-square h-full w-full" src="{{ $user->profilePicture() }}">
                    </span>
                    <h3 class="font-semibold tracking-tight text-xl mb-3">{{ $user->name }}</h3>
                    <div
                        class="flex justify-center items-center text-center rounded-full border mt-4 px-2.5 py-2 text-sm font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent hover:bg-primary/80
                        {{ $user->is_active ? 'text-green-600 bg-green-500/10' : 'text-red-500 bg-red-500/10' }}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </div>
                </div>
                <div class="p-6 pt-0 space-y-4">
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-mail h-4 w-4 text-gray-400">
                            <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                        </svg>
                        <span class="text-sm">{{ $user->email }}</span>
                    </div>
                    {{-- <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-phone h-4 w-4 text-gray-400">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                            </path>
                        </svg>
                        <span class="text-sm">+1 (555) 123-4567</span>
                    </div> --}}
                    <div class="flex items-center space-x-3"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-map-pin h-4 w-4 text-gray-400">
                            <path
                                d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0">
                            </path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span class="text-sm">{{ $user->address }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-calendar h-4 w-4 text-gray-400">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                        </svg>
                        <span class="text-sm">Joined {{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center space-x-3"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-clock h-4 w-4 text-gray-400">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg><span class="text-sm">Last logged in {{ $user->last_login_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2 space-y-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="rounded-lg border bg-white text-card-foreground shadow-sm">
                    <div class="p-6 pt-6">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-book-open h-6 w-6 mx-auto text-blue-600 mb-2">
                                <path d="M12 7v14"></path>
                                <path
                                    d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z">
                                </path>
                            </svg>
                            <div class="text-2xl font-bold">{{ $user->rentals()->count() }}</div>
                            <p class="text-xs text-gray-600">Total Rented</p>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg border bg-white text-card-foreground shadow-sm">
                    <div class="p-6 pt-6">
                        <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="lucide lucide-clock h-6 w-6 mx-auto text-green-600 mb-2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <div class="text-2xl font-bold">{{ $this->currentRentals() }}</div>
                            <p class="text-xs text-gray-600">Current Rentals</p>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg border bg-white text-card-foreground shadow-sm">
                    <div class="p-6 pt-6">
                        <div class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-heart h-6 w-6 mx-auto text-red-600 mb-2">
                                <path
                                    d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                                </path>
                            </svg>
                            <div class="text-2xl font-bold">{{ $user->wishlist()->count() }}</div>
                            <p class="text-xs text-gray-600">Wishlist Items</p>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg border bg-white text-card-foreground shadow-sm">
                    <div class="p-6 pt-6">
                        <div class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-star h-6 w-6 mx-auto text-yellow-600 mb-2">
                                <path
                                    d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z">
                                </path>
                            </svg>
                            <div class="text-2xl font-bold">{{ round($user->reviews()->avg('rating'), 2) }}</div>
                            <p class="text-xs text-gray-600">Avg. Rating</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-lg border bg-white text-card-foreground shadow-sm">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="font-semibold tracking-tight text-lg">Account Details</h3>
                </div>
                <div class="p-6 pt-0 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div><label class="text-sm font-medium text-gray-600">Membership Type</label>
                            <p class="text-sm font-semibold">User</p>
                        </div>
                        <div><label class="text-sm font-medium text-gray-600">Total Payments</label>
                            <p class="text-sm font-semibold">NA</p>
                        </div>
                        <div><label class="text-sm font-medium text-gray-600">Overdue Books</label>
                            <p class="text-sm font-semibold">{{$this->overdueBooks()}}</p>
                        </div>
                        <div><label class="text-sm font-medium text-gray-600">User ID</label>
                            <p class="text-sm font-semibold">#{{ $user->id }}</p>
                        </div>
                    </div>
                    <div data-orientation="horizontal" role="none" class="shrink-0 bg-border h-[1px] w-full">
                    </div>
                    <div><label class="text-sm font-medium text-gray-600">Favorite Genres</label>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach ($user->favoriteGenres() as $genre)
                                <div
                                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground">
                                    {{ $genre->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded-lg border bg-white text-card-foreground shadow-sm">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="font-semibold tracking-tight text-lg">Recent Rentals</h3>
                </div>
                <div class="p-6 pt-0">
                    <div class="space-y-3">
                        @foreach ($user->rentals()->latest()->take(5)->get() as $rental)
                            <div class="flex items-center justify-between p-3 border rounded-lg">
                                <div>
                                    <p class="font-medium">{{ $rental->book->title }}</p>
                                    <p class="text-sm text-gray-600">Rented: {{ $rental->rented_at }}</p>
                                    @if ($rental->returned_at)
                                        <p class="text-sm text-gray-600">Returned: {{ $rental->returned_at }}</p>
                                    @endif
                                </div>
                                @if ($rental->returned_at)
                                    <div
                                        class="rounded border px-2 py-1 text-sm font-semibold text-gray-500 bg-gray-500/10">
                                        Returned
                                    </div>
                                @else
                                    <div
                                        class="rounded border px-2 py-1 text-sm font-semibold  text-green-600 bg-green-500/10">
                                        Active
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
