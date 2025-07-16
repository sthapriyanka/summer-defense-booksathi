<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.guest")]
class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $address = '';
    public $password_confirmation = '';
    public $agreeToTerms = false;
    public $showPassword = false;
    public $showConfirmPassword = false;


    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|same:password_confirmation',
        'password_confirmation' => 'required',
        'agreeToTerms' => 'accepted',
    ];

    public function register()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'Registration successful! Please log in.');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.register')->title('Register - Book Sathi');
    }
}

