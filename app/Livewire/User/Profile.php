<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

#[Layout('layouts.user')]
class Profile extends Component
{
    use Interactions;
    public $editProfile = false;

    public $name, $email, $profile_picture;

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ];
    }

    #[Computed()]
    public function userProfile()
    {
        return Auth::user();
    }

    #[Computed()]
    public function totalRentals()
    {
        return Auth::user()->rentals()->count();
    }

    #[Computed()]
    public function activeRentals()
    {
        // Assuming 'status' column exists and 'active' means currently rented
        return Auth::user()->rentals()->where('status', 'active')->count();
    }

    public function editProfile()
    {
        $user = Auth::user();
        $this->editProfile = true;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function saveProfile()
    {
        $this->validate();
        $user = Auth::user();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->save();
        $this->editProfile = false;
        $this->toast()->success('Profile Edited')->send();
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        redirect()->to(route('login'));
    }

    public function render()
    {
        return view('livewire.user.profile')
            ->title('Profile - Book Sathi');
    }
}
