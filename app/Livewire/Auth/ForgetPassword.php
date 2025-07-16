<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout("layouts.guest")]

class ForgetPassword extends Component
{
    public $email = '';
    public $emailSent = false;

    protected $rules = [
        'email' => 'required|email|exists:users,email',
    ];

    protected $messages = [
        'email.required' => 'Email address is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.exists' => 'We could not find a user with that email address.',
    ];
    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->emailSent = true;
            session()->flash('message', 'Password reset link sent to your email!');
        } else {
            $this->addError('email', __($status));
        }
    }
    public function render()
    {
        return view('livewire.auth.forget-password');
    }
}