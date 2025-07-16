<div class="max-w-md mx-auto mt-20 p-6 bg-white rounded-xl shadow-md space-y-6">
    <form wire:submit.prevent="login" class="space-y-4">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input wire:model.lazy="email" type="email" id="email"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="relative">
                <input wire:model.lazy="password" type="{{ $showPassword ? 'text' : 'password' }}" id="password"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 pr-10 focus:ring-indigo-500 focus:border-indigo-500"
                    required>
                <button type="button" wire:click="$toggle('showPassword')"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center mt-1" tabindex="-1">
                    @if($showPassword)
                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21">
                            </path>
                        </svg>
                    @else
                        <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    @endif
                </button>
            </div>
            @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" wire:model="remember"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
            <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">Forgot Password?</a>

        </div>

        <div>
            <button type="submit"
                class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
                Login
            </button>
        </div>
    </form>
    <div class="text-center pt-4 border-t border-gray-200">
        <p class="text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline">
                Register here
            </a>
        </p>
         @if(config('app.debug'))
            <p class="text-xs text-gray-400 mt-2">
                <a href="{{ route('debug.emails') }}" class="hover:text-gray-600">Debug: View Sent Emails</a>
            </p>
        @endif
    </div>
</div>