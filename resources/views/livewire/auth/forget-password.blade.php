<div class="max-w-md mx-auto mt-20 p-6 bg-white rounded-xl shadow-md space-y-6">
    <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Forgot Password</h2>
        <p class="text-gray-600">Enter your email address and we'll send you a link to reset your password.</p>
    </div>

    @if($emailSent)
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        Password reset link sent!
                    </p>
                    <p class="mt-1 text-sm text-green-700">
                        Check your email for a password reset link. If you don't see it, check your spam folder.
                    </p>
                </div>
            </div>
        </div>
    @else
        <form wire:submit.prevent="sendResetLink" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input wire:model.lazy="email" 
                       type="email" 
                       id="email"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="Enter your email address"
                       required>
                @error('email') 
                    <span class="text-red-600 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <div>
                <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
                    Send Reset Link
                </button>
            </div>
        </form>
    @endif

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
