<div class="container mx-auto px-6 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="rounded-lg border bg-card text-card-foreground mb-8 border-green-200 shadow-lg bg-white">
            <div class="flex flex-col space-y-1.5 p-6 text-center pb-4">
                <div class="flex flex-col items-center space-y-4">
                    <div
                        class="relative flex shrink-0 overflow-hidden rounded-full w-24 h-24 border-4 border-green-200">
                        <img src="{{ $this->userProfile->profilePicture() }}" class="h-full w-full rounded-full "
                            alt="Profile Picture" />
                    </div>
                    <div>
                        <h3 class="font-semibold tracking-tight text-2xl text-gray-800">{{ $this->userProfile->name }}
                        </h3>
                        <p class="text-gray-600 flex items-center justify-center mt-2">
                            <x-icon icon="envelope-open" class="w-4 h-4 mr-2" />
                            {{ $this->userProfile->email }}
                        </p>
                    </div>
                    <button
                        class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg]:size-4 [&_svg]:shrink-0 border bg-background hover:text-accent-foreground h-10 px-4 py-2 border-green-300 text-green-700 hover:bg-green-50">
                        <x-icon icon="pencil-square" class="w-4 h-4 mr-2" />
                        Edit Profile
                    </button>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="rounded-lg border bg-white border-green-200 shadow-lg">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-user w-5 h-5 mr-2">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Account Information
                    </h3>
                </div>
                <div class="p-6 pt-0 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">
                            Member Since:
                        </span>
                        <span class="font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4 mr-2 text-green-600">
                                <path d="M8 2v4"></path>
                                <path d="M16 2v4"></path>
                                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                                <path d="M3 10h18"></path>
                            </svg>
                            {{ $this->userProfile->created_at->format('F Y') }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Rentals:</span>
                        <span class="font-medium text-green-700">{{ $this->totalRentals }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Active Rentals:</span>
                        <span class="font-medium text-emerald-600">{{ $this->activeRentals }}</span>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border bg-white border-green-200 shadow-lg">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl font-semibold leading-none tracking-tight flex items-center text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-book-open w-5 h-5 mr-2">
                            <path d="M12 7v14"></path>
                            <path
                                d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z">
                            </path>
                        </svg>
                        Quick Actions
                    </h3>
                </div>
                <div class="p-6 pt-0 space-y-3">
                    <a href="{{ route('my-rentals') }}"
                        class="inline-flex items-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border bg-background hover:text-accent-foreground h-10 px-4 py-2 w-full justify-start border-green-300 text-green-700 hover:bg-green-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-book-open w-4 h-4 mr-2">
                            <path d="M12 7v14"></path>
                            <path
                                d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z">
                            </path>
                        </svg>
                        View My Rentals
                    </a>
                    <a href="{{ route('wishlist') }}"
                        class="inline-flex items-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border bg-background hover:text-accent-foreground h-10 px-4 py-2 w-full justify-start border-green-300 text-green-700 hover:bg-green-50">
                        View Wishlist
                    </a>
                    <a href="{{ route('books') }}"
                        class="inline-flex items-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border bg-background hover:text-accent-foreground h-10 px-4 py-2 w-full justify-start border-green-300 text-green-700 hover:bg-green-50">
                        Browse Books
                    </a>
                </div>
            </div>
        </div>

        <div class="rounded-lg border bg-card text-card-foreground border-red-200 shadow-lg">
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="text-2xl font-semibold leading-none tracking-tight text-red-600">Account Actions</h3>
            </div>
            <div class="p-6 pt-0">
                <button wire:click='logout'
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-destructive-foreground h-10 px-4 py-2 bg-red-600 hover:bg-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-log-out w-4 h-4 mr-2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" x2="9" y1="12" y2="12"></line>
                    </svg>
                    Logout
                </button>
                <p class="text-sm text-gray-600 mt-2">
                    You will be signed out of your account and redirected to the login page.
                </p>
            </div>
        </div>
    </div>
</div>