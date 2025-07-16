<?php

namespace App\Livewire\User;

use App\Models\Cart as ModelCart;
use DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Services\AddToCartService;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.user')]
class Cart extends Component
{
    use Interactions;

    public $cartItems;
    public $rentalDurations = [];

    public $selectedItems = [];

    public function mount()
    {
        $this->loadCartItems();
    }

    #[Computed()]
    public function loadCartItems()
    {
        $this->cartItems = app(AddToCartService::class)->getCartItems();

        if($this->cartItems){
            foreach ($this->cartItems as $cart) {
                $this->rentalDurations[$cart->book_id] = 1;   //rental duration is set to 1 week by default
            }

            $this->selectedItems = $this->cartItems->pluck('book_id')->toArray();
        }
    }

    public function removeItem($itemId)
    {
        $remove = app(AddToCartService::class)->removeBookFromCart($itemId); 
        
        if(!$remove) return;
        
        $this->toast()->success('Item removed')->send();

        $this->loadCartItems();
        $this->dispatch("cart-updated");

    }
    
    public function render()
    {
        return view('livewire.user.cart')
            ->title('Cart - Book Sathi');
    }

    public function calculateTotal(){
        $total = 0;
        foreach ($this->cartItems as $cart) {
            if (in_array($cart->book_id, $this->selectedItems)) {
            $duration = $this->rentalDurations[$cart->book_id] ?? $cart->rental_duration_weeks;
            $pricePerWeek = $cart->book->rental_price_per_week;
            $total += $duration * $pricePerWeek;
            }
        }
        return $total;
    }

    public function updateRentalDurations()
    {
        $cart = ModelCart::where('user_id', auth()->id())->first();

        foreach ($this->selectedItems as $bookId) {
            $duration = $this->rentalDurations[$bookId] ?? 1;

            $cartItem = $cart->items()->where('book_id', $bookId)->first();

            if ($cartItem && $cartItem->book) {
                $bookPrice = $cartItem->book->rental_price_per_week;

                $cartItem->update([
                    'rental_duration_in_weeks' => $duration,
                    'total_price' => $bookPrice * $duration,
                ]);
            }
        }
    }


    public function checkout()
    {
        if (empty($this->selectedItems)) {
            $this->toast()->error('Please select at least one item to proceed.')->send();
            return;
        }

        $this->updateRentalDurations();

        session()->put('selected_items', $this->selectedItems);
        return redirect()->route('checkout');
    }
}
