<?php

namespace App\Livewire\Layout;

use App\Http\Repositories\Config\Interfaces\MenuRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Sidebar extends Component
{
    public $collapsed = false;
    public $menuItems = [];

    public function mount()
    {
        $this->menuItems = [
            [
                "id" => 1,
                "label" => "Dashboard",
                "url" => route('admin.dashboard'),
                "icon" => "squares-2x2",
                "children" => [],
            ],
            [
                "id" => 2,
                "label" => "Books",
                "url" => route('admin.books'),
                "icon" => "book-open",
                "children" => [],
            ],
            [
                "id" => 3,
                'label' => 'Users',
                'url' => route('admin.users'),
                'icon' => 'users',
                'children' => [],
            ],
            [
                "id" => 4,
                'label' => 'Rentals',
                'url' => route('admin.rental'),
                'icon' => 'clock',
                'children' => [],
            ],
            [
                "id" => 5,
                'label' => 'Orders',
                'url' => '/admin/orders',
                'icon' => 'shopping-bag',
                'children' => [],
            ],
            [
                "id" => 6,
                'label' => 'Payments',
                'url' => '/admin/payments',
                'icon' => 'currency-dollar',
                'children' => [],
            ]
        ];
    }

    public function toggleSidebar()
    {
        $this->collapsed = !$this->collapsed;
    }

    // #[Computed(persist: true)]
    // public function menuItems(MenuRepositoryInterface $menuRepo)
    // {
    //     return $this->menuRepo->getUserAuthorizedMenu();
    // }

    public function render()
    {
        return view('livewire.layout.sidebar');
    }
}
