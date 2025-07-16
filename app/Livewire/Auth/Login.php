<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.guest")]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;
    public $showPassword = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (
            Auth::attempt(
                ['email' => $this->email, 'password' => $this->password],
                $this->remember
            )
        ) {
            $user = User::where('email', $this->email)->first();
            $user->last_login_at = now();
            $user->save();
            session()->regenerate();
            if ($user->role == 'user') {
                return redirect()->intended(route('home'));
            } else {
                return redirect()->intended(route('admin.dashboard'));
            }
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login')        
            ->title('Login - Book Sathi');
    }
}
