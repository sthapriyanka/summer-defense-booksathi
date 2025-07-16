<x-modal title="Payment" wire="paymentModal" persistent center x:on:close="$wire.clearForm" size="xl">
    <div class="grid grid-cols-2 gap-4">

        <!-- Order No. -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Order No.</label>
            <input type="text" readonly class="mt-1 w-full px-3 py-2 border rounded bg-gray-100"
                value="{{ $order_number }}">
        </div>

        <!-- Total Amount -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Total Amount (Rs.)</label>
            <input type="text" readonly class="mt-1 w-full px-3 py-2 border rounded bg-gray-100"
                value="{{ number_format($amount, 2) }}">
        </div>

        <!-- Payment Mode -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Payment Mode</label>
            <select wire:model.live="payment_mode" class="mt-1 w-full px-3 py-2 border rounded">
                <option value="">-- Select Payment Mode --</option>
                <option value="cash">Cash</option>
                <option value="card">Card</option>
                <option value="online">ConnectIPS</option>
            </select>
            @error('payment_mode')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <x-slot:footer>
        <div class="flex justify-end space-x-2">
            <button type="button" wire:click="cancelPayment()"
                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>

            <button type="button" wire:click="submitPayment()"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
        </div>
    </x-slot:footer>
</x-modal>
