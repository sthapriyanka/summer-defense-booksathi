<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Traits\WithDataTable;
use App\Traits\WithDataTable2;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Users extends Component
{
    use WithDataTable;

    public $totalUserCount = 0;
    public $activeUserCount = 0;
    public $newUserCount = 0;
    public $inactiveUserCount = 0;
    public $search = "";

    public $headers = [
        ['index' => 'name', 'label' => 'Name', 'sortable' => true],
        ['index' => 'email', 'label' => 'Contact', 'sortable' => true],
        ['index' => 'last_login_at', 'label' => 'Status', 'sortable' => true],
        ['index' => 'created_at', 'label' => 'Joined Date', 'sortable' => true],
        ['index' => 'rental_count', 'label' => 'Books Rented', 'sortable' => false],
        ['index' => 'current_rental', 'label' => 'Current Rental', 'sortable' => false],
        ['index' => 'wishlist_count', 'label' => 'Wishlist', 'sortable' => false],
        ['index' => 'action', 'label' => 'Action', 'sortable' => false]
    ];


    public function mount()
    {
        $this->sort = [
            'column' => 'name',
            'direction' => 'asc'
        ];
        $this->calculateUserCounts();
    }

    public function calculateUserCounts()
    {
        $this->totalUserCount = User::where('role', 'user')->count();
        $this->activeUserCount = User::where('role', 'user')->active()->count();
        $this->newUserCount = User::where('role', 'user')->new()->count();
        $this->inactiveUserCount = User::where('role', 'user')->inactive()->count();
    }

    #[Computed()]
    public function list()
    {
        $users = User::query()
            ->when($this->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->where('role', 'user')
            ->orderBy($this->sort['column'], $this->sort['direction'])
            ->select('id', 'name', 'email', 'last_login_at', 'created_at')
            ->withCount('rentals')
            ->withCount('wishlist')
            ->latest()
            ->paginate($this->perPage);

        foreach ($users as $user) {
            $user->rental_count = $user->rentals_count;
            $user->last_login_at = $user->last_login_at->format('d M Y');
            $user->status = $user->is_active ? 'active' : 'inactive';
            $user->created_at = $user->created_at->format('d M Y');
            $user->current_rental = $user->rentals->whereNull('returned_at')->where('due_date', '<=', now())->count();
            // $user->wishlist_count = $user->wishlist_count;
        }

        return $users;
    }

    public function render()
    {
        return view('livewire.admin.users');
    }
}
