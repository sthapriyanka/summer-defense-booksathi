<?php

namespace App\Livewire\Layout;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;

class Navbar extends Component
{

    #[Url(as: 'search')]
    public $search = "";

    #[Computed(persist: true)]
    public function user()
    {
        return Auth::user();
    }

    #[Computed(persist: true)]
    public function profilePicture()
    {
        $name = $this->user->name;
        $urlName = join('+', explode(' ', $name));
        return "https://ui-avatars.com/api/?name={$urlName}";
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();
        $this->redirect('/');
    }

    public function render()
    {
        return view('livewire.layout.navbar');
    }
}