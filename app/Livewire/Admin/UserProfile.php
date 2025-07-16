<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserProfile extends Component
{

    public User $user;
    public $isActive = false;
    // public $userId = null;

    public function mount($id) {
        $this->user = User::where('role', 'user')->where('id', $id)->firstOrFail();
        // $this->userId = $id;
    }

    public function currentRentals()
    {
        return $this->user->rentals()
            ->whereNull('returned_at')
            ->whereIn('status', ['rented', 'overdue'])
            ->where('due_date', '<=', now())->count();
    }

    public function overdueBooks()
    {
        return $this->user->rentals()
            ->whereNull('returned_at')
            ->where('status', 'overdue')
            ->where('due_date', '<=', now())->count();
    }

    public function render()
    {
        return view('livewire.admin.user-profile');
    }
}
