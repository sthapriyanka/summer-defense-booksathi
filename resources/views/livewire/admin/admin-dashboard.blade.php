<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-600 mt-1">Welcome back! Here's what's happening with your book rental system.</p>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="rounded-lg border text-card-foreground bg-white shadow-sm hover:shadow-md transition-shadow">
            <div class="p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium">Total Books</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-book-open h-4 w-4 text-green-600">
                    <path d="M12 7v14"></path>
                    <path
                        d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z">
                    </path>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-gray-900">{{ number_format($totalBooks) }}</div>
                <p class="text-xs text-green-600 mt-1">+{{ $bookGrowth }}% from last month</p>
            </div>
        </div>
        <div class="rounded-lg border text-card-foreground bg-white shadow-sm hover:shadow-md transition-shadow">
            <div class="p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium">Rented Today</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-calendar h-4 w-4 text-green-600">
                    <path d="M8 2v4"></path>
                    <path d="M16 2v4"></path>
                    <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                    <path d="M3 10h18"></path>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-gray-900">{{ number_format($rentedToday) }}</div>
                <p class="text-xs text-green-600 mt-1">+{{ $rentedGrowth }}% from yesterday</p>
            </div>
        </div>
        <div class="rounded-lg border text-card-foreground bg-white shadow-sm hover:shadow-md transition-shadow">
            <div class="p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium">Total Users</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-users h-4 w-4 text-green-600">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-gray-900">{{ number_format($totalUsers) }}</div>
                <p class="text-xs text-green-600 mt-1">+{{ $userGrowth }}% from last month</p>
            </div>
        </div>
        <div class="rounded-lg border text-card-foreground bg-white shadow-sm hover:shadow-md transition-shadow">
            <div class="p-6 flex flex-row items-center justify-between space-y-0 pb-2">
                <h3 class="tracking-tight text-sm font-medium">Active Rentals</h3>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-activity h-4 w-4 text-green-600">
                    <path
                        d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2">
                    </path>
                </svg>
            </div>
            <div class="p-6 pt-0">
                <div class="text-2xl font-bold text-gray-900">{{ number_format($activeRentals) }}</div>
                <p class="text-xs text-green-600 mt-1">+{{ $rentalGrowth }}% from last week</p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <livewire:admin.dashboard.weekly-bar-graph />
        <livewire:admin.dashboard.monthly-rental-trend />
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="rounded-lg border text-card-foreground bg-white shadow-sm">
            <div class="flex flex-col space-y-1.5 p-6">
                <h3 class="text-2xl font-semibold leading-none tracking-tight">Most Rented Books</h3>
                <p class="text-sm text-muted-foreground">Top performing books this month</p>
            </div>
            <div class="p-6 pt-0">
                <div class="space-y-4">
                    @foreach ($this->mostRentedBooks as $book)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-8 rounded" style="background-color:{{ $book->color }};"></div><span
                                    class="font-medium text-sm">{{ $book->title }}</span>
                            </div><span class="text-sm font-semibold text-gray-900">{{ $book->rental_count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- <div class="rounded-lg border text-card-foreground bg-white shadow-sm">
                <div class="flex flex-col space-y-1.5 p-6">
                    <h3 class="text-2xl font-semibold leading-none tracking-tight">Recent Activity</h3>
                    <p class="text-sm text-muted-foreground">Latest system activities</p>
                </div>
                <div class="p-6 pt-0">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 rounded-full mt-2 bg-green-500"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">Book "The Alchemist" rented by John Doe</p>
                                <p class="text-xs text-gray-500">2 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 rounded-full mt-2 bg-blue-500"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">New user "Jane Smith" registered</p>
                                <p class="text-xs text-gray-500">15 minutes ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 rounded-full mt-2 bg-yellow-500"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">Book "Harry Potter" returned by Mike Johnson</p>
                                <p class="text-xs text-gray-500">1 hour ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 rounded-full mt-2 bg-purple-500"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">Book "Dune" added to inventory</p>
                                <p class="text-xs text-gray-500">2 hours ago</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 rounded-full mt-2 bg-blue-500"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-900">User "Sarah Wilson" updated profile</p>
                                <p class="text-xs text-gray-500">3 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
    </div>
    <div class="rounded-lg border text-card-foreground bg-white shadow-sm">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="text-2xl font-semibold leading-none tracking-tight">Quick Actions</h3>
            <p class="text-sm text-muted-foreground">Common administrative tasks</p>
        </div>
        <div class="p-6 pt-0">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <button
                    class="gap-2 whitespace-nowrap rounded-md text-white text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 text-primary-foreground px-4 py-2 h-20 flex flex-col items-center justify-center space-y-2 bg-green-600 hover:bg-green-700">
                    <x-icon icon="plus" class="h-6 w-6" />
                    <span class="text-sm">Add New Book</span>
                </button>
                <button
                    class="gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border bg-background hover:text-accent-foreground px-4 py-2 h-20 flex flex-col items-center justify-center space-y-2 border-green-200 hover:bg-green-50">
                    <x-icon icon="book-open" class="h-6 w-6" />
                    <span class="text-sm">View All Books</span>
                </button>
                <button
                    class="gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border bg-background hover:text-accent-foreground px-4 py-2 h-20 flex flex-col items-center justify-center space-y-2 border-green-200 hover:bg-green-50">
                    <x-icon icon="user-group" class="h-6 w-6" />
                    <span class="text-sm">Manage Users</span>
                </button>
                <button
                    class="gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border bg-background hover:text-accent-foreground px-4 py-2 h-20 flex flex-col items-center justify-center space-y-2 border-green-200 hover:bg-green-50">
                    <x-icon icon="clock" class="h-6 w-6" />
                    <span class="text-sm">Rental History</span>
                </button>
            </div>
        </div>
    </div>
</div>
