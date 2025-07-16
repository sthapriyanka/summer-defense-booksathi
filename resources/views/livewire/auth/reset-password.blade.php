<div class="max-w-md mx-auto mt-20 p-6 bg-white rounded-xl shadow-md space-y-6">
    <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Reset Password</h2>
        <p class="text-gray-600">Enter your new password below.</p>
    </div>

    <form wire:submit.prevent="resetPassword" class="space-y-4">
        <!-- Email (hidden, pre-filled from URL) -->
        <input type="hidden" wire:model="email">
        
        <!-- New Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
            <div class="relative">
                <input wire:model.lazy="password" 
                       type="{{ $showPassword ? 'text' : 'password' }}" 
                       id="password"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 pr-10 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="Enter your new password"
                       required>
                <button type="button" 
                        wire:click="$toggle('showPassword')" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1"
                        tabindex="-1">
                    @if($showPassword)
                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    @else
                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    @endif
                </button>
            </div>
            @error('password') 
                <span class="text-red-600 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
            <div class="relative">
                <input wire:model.lazy="password_confirmation" 
                       type="{{ $showConfirmPassword ? 'text' : 'password' }}" 
                       id="password_confirmation"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 pr-10 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="Confirm your new password"
                       required>
                <button type="button" 
                        wire:click="$toggle('showConfirmPassword')" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1"
                        tabindex="-1">
                    @if($showConfirmPassword)
                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    @else
                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    @endif
                </button>
            </div>
            @error('password_confirmation') 
                <span class="text-red-600 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Email Display (for user confirmation) -->
        @if($email)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                <p class="text-sm text-gray-600">
                    <span class="font-medium">Email:</span> {{ $email }}
                </p>
            </div>
        @endif

        <!-- Error Messages -->
        @error('email') 
            <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                <p class="text-sm text-red-600">{{ $message }}</p>
            </div>
        @enderror

        @error('token') 
            <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                <p class="text-sm text-red-600">{{ $message }}</p>
            </div>
        @enderror

        <div>
            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
                Reset Password
            </button>
        </div>
    </form>

    <!-- Back to Login -->
    <div class="text-center pt-4 border-t border-gray-200">
        <p class="text-sm text-gray-600">
            Remember your password? 
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline">
                Back to login
            </a>
        </p>
    </div>
</div>
