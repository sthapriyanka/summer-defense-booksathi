<div>
    <!-- Header with Add Button -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Users Management</h1>
            <p class="text-gray-600 mt-1">Manage your registered users</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="rounded-lg border text-card-foreground bg-white shadow-sm">
            <div class="p-6 pt-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalUserCount }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-user-check h-8 w-8 text-green-600">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <polyline points="16 11 18 13 22 9"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="rounded-lg border text-card-foreground bg-white shadow-sm">
            <div class="p-6 pt-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Active Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $activeUserCount }}</p>
                    </div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-user-check h-8 w-8 text-green-600">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <polyline points="16 11 18 13 22 9"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="rounded-lg border text-card-foreground bg-white shadow-sm">
            <div class="p-6 pt-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">New This Month</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $newUserCount }}</p>
                    </div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-user-check h-8 w-8 text-blue-600">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <polyline points="16 11 18 13 22 9"></polyline>
                    </svg>
                </div>
            </div>
        </div>
        <div class="rounded-lg border text-card-foreground bg-white shadow-sm">
            <div class="p-6 pt-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Inactive Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $inactiveUserCount }}</p>
                    </div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-user-x h-8 w-8 text-gray-600">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <line x1="17" x2="22" y1="8" y2="13"></line>
                        <line x1="22" x2="17" y1="8" y2="13"></line>
                    </svg>
                </div>
            </div>
        </div>
    </div>


    <!-- Search Bar -->
    <div class="my-6">
        <div class="relative">
            <input wire:model.live.debounce.300ms="search" type="text"
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                placeholder="Search books by name or email...">
            <div class="absolute left-3 top-3.5">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <x-table :$headers :rows="$this->list" :$sort paginate striped :target='[]' sm>
        @interact('column_name', $user)
            <div class="flex items-center space-x-3">
                <span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full">
                    <img class="aspect-square h-full w-full" src="{{ $user->profilePicture() }}">
                </span>
                <div>
                    <div class="font-medium text-gray-900">{{ $user->name }}</div>
                    <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                </div>
            </div>
        @endinteract
        @interact('column_email', $user)
            <div class="space-y-1">
                <div class="flex items-center space-x-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-mail h-3 w-3 text-gray-400">
                        <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                    </svg>
                    <span>{{ $user->email }}</span>
                </div>
                {{-- <div class="flex items-center space-x-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-phone h-3 w-3 text-gray-400">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                        </path>
                    </svg>
                    <span>+1 (555) 123-4567</span>
                </div> --}}
            </div>
        @endinteract
        @interact('column_last_login_at', $user)
            @if ($user->status === 'active')
                <span class="text-sm font-medium text-green-500 px-2 py-1 bg-green-500/10 rounded">Active</span>
            @else
                <span class="text-sm font-medium text-red-500 px-2 py-1 bg-red-500/10 rounded">Inactive</span>
            @endif
        @endinteract
        @interact('column_created_at', $row)
            {{ $row->created_at->format('M d, Y') }}
        @endinteract
        @interact('column_action', $row)
            <div class="flex justify-left gap-4">
                <a
                    href="{{ route('admin.users.profile', $row->id) }}"
                    class="inline-flex items-center hover:bg-green-500 hover:text-white justify-center gap-2 whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3">
                    View Profile
                </a>
            </div>
        @endinteract
    </x-table>

</div>
