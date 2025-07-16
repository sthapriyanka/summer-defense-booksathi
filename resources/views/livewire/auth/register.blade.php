<div class="max-w-lg w-full relative z-10">
    <div class="text-center mb-8">
        <a href="/" class="inline-flex items-center space-x-3 text-white group">
            <div class="relative">
                <x-icon icon="book-open" class="h-10 w-10 text-green-300" outline />
            </div>
            <span
                class="text-3xl font-bold bg-gradient-to-r from-green-300 to-emerald-200 bg-clip-text text-transparent">
                BookSathi
            </span>
        </a>
        <p class="text-green-200 mt-2">Join thousands of book lovers</p>
    </div>

    <div class="bg-white/15 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl p-8 backdrop-saturate-150">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-white">Create Account</h2>
            <p class="text-green-100 mt-2">Start your reading journey today</p>
        </div>

        <form wire:submit.prevent="register" class="space-y-6">
            @if (session()->has('success'))
                <div class="text-green-400 text-sm bg-green-900/30 p-3 rounded-lg border border-green-500/30">
                    {{ session('success') }}
                </div>
            @endif

            <div>
                <label for="name" class="block text-sm font-medium text-white mb-2">Full Name</label>
                <input wire:model.lazy="name" type="text" id="name"
                    class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all duration-300 text-white placeholder-green-100"
                    placeholder="Enter your full name" required>
                @error('name') <span class="text-red-300 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-white mb-2">Email</label>
                <input wire:model.lazy="email" type="email" id="email"
                    class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all duration-300 text-white placeholder-green-100"
                    placeholder="john@example.com" required>
                @error('email') <span class="text-red-300 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-white mb-2">Address</label>
                <input wire:model.lazy="address" id="address"
                    class="w-full px-4 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all duration-300 text-white placeholder-green-100"
                    placeholder="Enter your address">
                @error('address') <span class="text-red-300 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
                <div class="relative">
                    <input wire:model.lazy="password" type="{{ $showPassword ? 'text' : 'password' }}" id="password"
                        class="w-full px-4 py-3 pr-12 bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all duration-300 text-white placeholder-green-100"
                        required placeholder="Enter your password">
                    <button type="button" wire:click="$toggle('showPassword')"
                        class="absolute right-4 top-3.5 text-green-200 hover:text-white transition-colors"
                        tabindex="-1">
                        @if($showPassword)
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21">
                                </path>
                            </svg>
                        @else
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        @endif
                    </button>
                </div>
                @error('password') <span class="text-red-300 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">Confirm
                    Password</label>
                <div class="relative">
                    <input wire:model.lazy="password_confirmation"
                        type="{{ $showConfirmPassword ? 'text' : 'password' }}" id="password_confirmation"
                        class="w-full px-4 py-3 pr-12 bg-white/20 backdrop-blur-sm border border-white/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition-all duration-300 text-white placeholder-green-100"
                        required placeholder="Confirm your password">
                    <button type="button" wire:click="$toggle('showConfirmPassword')"
                        class="absolute right-4 top-3.5 text-green-200 hover:text-white transition-colors"
                        tabindex="-1">
                        @if($showConfirmPassword)
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21">
                                </path>
                            </svg>
                        @else
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        @endif
                    </button>
                </div>
                @error('password_confirmation') <span class="text-red-300 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" wire:model="agreeToTerms"
                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded" required>
                <label class="ml-2 block text-sm text-white">
                    I agree to the
                    <a href="#" class="text-green-300 hover:text-green-100 transition-colors">
                        Terms & Conditions
                    </a>
                    and
                    <a href="#" class="text-green-300 hover:text-green-100 transition-colors">
                        Privacy Policy
                    </a>
                </label>
            </div>
            @error('agreeToTerms') <span class="text-red-300 text-sm">{{ $message }}</span> @enderror

            <button type="submit"
                class="w-full bg-green-600/80 backdrop-blur-sm hover:bg-green-700/80 text-white py-3 px-4 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 border border-green-500/30">
                Create Account
            </button>
        </form>

        <div class="mt-8 text-center f;ex justify-center items-center gap-2">
            <p class="text-sm text-green-100">
                Already have an account?
                <a href="/login" class="font-medium text-green-300 hover:text-green-100 transition-colors">
                    Sign in here
                </a>
            </p>
        </div>
    </div>
</div>
