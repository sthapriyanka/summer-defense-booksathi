<section>
    <div class="flex justify-between">
        <h1 class="text-2xl font-bold">Books</h1>
        <x-button wire:click="$toggle('bookForm')">Add</x-button>
    </div>
    <div class="section">
        <x-table :$headers :rows="$this->list" :$sort paginate striped
            :filter="['quantity' => 'perPage', 'search' => 'search']" :quantity="[10, 25, 50]" :target='[]'>
            @interact('column_price', $row)
            {{ number_format($row->rental_price_per_week, 2) }} @endinteract
            @interact('column_action', $row)
            <x-dropdown icon="wrench-screwdriver" label="Actions" align="right">
                <x-dropdown.items icon="eye" text="View" wire:click="view({{ $row->id }})" />
                <x-dropdown.items icon="pencil" text="Edit" wire:click="edit({{ $row->id }})" />
                <x-dropdown.items icon="trash" text="Delete" wire:click="delete({{ $row->id }})" />
            </x-dropdown>
            @endinteract
        </x-table>
    </div>

    <x-modal title="{{ $editingId ? 'Edit Book' : 'Add Book' }}" wire="bookForm" persistent center
        x-on:close="$wire.clearForm" size="sm">

        <form wire:submit='save'>
            <div class="flex flex-col gap-4">
                <x-input label="Title *" wire:model="title" error="{{ $errors->first('title') }}" />
                <x-input label="ISBN" wire:model="isbn" error="{{ $errors->first('isbn') }}" />
                <x-input label="Description" wire:model="description" error="{{ $errors->first('description') }}" />
                <x-input label="Available Copies *" wire:model="available_copies" type="number"
                    error="{{ $errors->first('available_copies') }}" />
                <x-input label="Rental Price per Week *" wire:model="rental_price_per_week" type="number"
                    error="{{ $errors->first('rental_price_per_week') }}" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button type="submit" loading="save">Save</x-button>
            </div>
        </form>
    </x-modal>
</section>