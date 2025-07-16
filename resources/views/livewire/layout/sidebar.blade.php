<div class="relative">
    <aside :class="`${$store.sidebar.collapsed ? 'w-0' : 'w-full md:w-64'} overflow-x-hidden overflow-y-auto`"
        @mouseenter="$store.sidebar.expandOnHover" @mouseleave="$store.sidebar.collapseOnLeave"
        class="transition-all duration-300 bg-[#FAFAFA] border-[#e2e8f0] border-r text-[#3f3f46] h-screen fixed z-30">
        <div class="flex items-center gap-2 px-4 py-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-book h-6 w-6 text-primary">
                <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H19a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6.5a1 1 0 0 1 0-5H20"></path>
            </svg><span class="font-bold text-lg">BookSathi Admin</span></div>

        <nav class="mt-6 space-y-1 px-2">
            @foreach ($menuItems as $menu)
                @php
                    $isActiveParent =
                        request()->is($menu['url']) ||
                        collect($menu['children'])->pluck('url')->filter(fn($url) => request()->is($url))->isNotEmpty();
                @endphp

                <div x-data="{ dropdownOpen: {{ $isActiveParent ? 'true' : 'false' }} }">
                    @if (count($menu['children']) > 0)
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center w-full px-2 py-2 rounded-md hover:bg-[#f4f4f5] transition {{ $isActiveParent ? 'bg-[#f4f4f5]' : '' }}">
                            <x-icon name="{{ $menu['icon'] }}" class="w-5 h-5" outline />
                            <span :class="$store.sidebar.collapsed ? 'hidden' : 'ml-2'">
                                {{ $menu['label'] }}
                            </span>
                            <svg class="ml-auto w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                :class="$store.sidebar.collapsed ? 'hidden' : ''">
                                <path x-show="!dropdownOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M19 9l-7 7-7-7" />
                                <path x-show="dropdownOpen" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        </button>

                        <div x-show="dropdownOpen" x-collapse :class="$store.sidebar.collapsed ? 'hidden' : ''">
                            @foreach ($menu['children'] as $child)
                                @php $isActive = request()->is($child['url']); @endphp
                                <a href="{{ url($child['url']) }}"
                                    class="flex items-center w-full px-2 py-2 rounded-md ml-4 hover:bg-[#f4f4f5] transition {{ $isActive ? 'bg-[#f4f4f5] font-semibold' : '' }}">
                                    <x-icon name="{{ $child['icon'] }}" class="w-5 h-5" outline />
                                    <span :class="$store.sidebar.collapsed ? 'hidden' : 'ml-2'">
                                        {{ $child['label'] }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    @else
                        @php $isActive = request()->is($menu['url']); @endphp
                        <a href="{{ url($menu['url']) }}"
                            class="flex items-center w-full px-2 py-2 rounded-md hover:bg-[#f4f4f5] transition {{ $isActive ? 'bg-[#f4f4f5] font-semibold' : '' }}">
                            <x-icon name="{{ $menu['icon'] }}" class="w-5 h-5" outline />
                            <span :class="$store.sidebar.collapsed ? 'hidden' : 'ml-2'">
                                {{ $menu['label'] }}
                            </span>
                        </a>
                    @endif
                </div>
            @endforeach
        </nav>
    </aside>
</div>
