<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Book\Book;
use App\Livewire\Rental\BookRental;
use App\Livewire\User\BookDetail;
use App\Livewire\User\BrowsePage;
use App\Livewire\User\HomePage;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\BooksTable;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/books', BooksTable::class)->name('admin.books');
    Route::get('/users', \App\Livewire\Admin\Users::class)->name('admin.users');
    Route::get('/users/{id}', \App\Livewire\Admin\UserProfile::class)->name('admin.users.profile');
    // Route::get('/books', Book::class)->name('books');
    Route::get('/book-rental', BookRental::class)->name('admin.rental');
    Route::get('/orders', \App\Livewire\Admin\OrderTable::class)->name('admin.orders');
    Route::get('/payments', \App\Livewire\Admin\PaymentPage::class)->name('admin.payments');
});

Route::get('/', HomePage::class)->name('home');
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('books', BrowsePage::class)->name('books');
    Route::get('books/{id}', BookDetail::class)->name('books.detail');
    Route::get('/cart', \App\Livewire\User\Cart::class)->name('cart');
    Route::get('/my-rentals', \App\Livewire\User\MyRentals::class)->name('my-rentals');
    Route::get('/profile', \App\Livewire\User\Profile::class)->name('profile');
    Route::get('/wishlist', \App\Livewire\User\Wishlist::class)->name('wishlist');
    Route::get('/genres', \App\Livewire\User\Genre::class)->name('genres');
    Route::get('/checkout', \App\Livewire\User\Checkout::class)->name('checkout');
    Route::get('/orders', \App\Livewire\User\Orders::class)->name('orders');
});


Route::get('/login', Login::class)->name('login');

Route::get('/register', Register::class)->name('register');
Route::get('/forgot-password', \App\Livewire\Auth\ForgetPassword::class)->name('password.request');
Route::get('/reset-password/{token}', \App\Livewire\Auth\ResetPassword::class)->name('password.reset');

Route::get('/debug/emails', function () {
    $logFile = storage_path('logs/laravel.log');
    $emails = [];

    if (file_exists($logFile)) {
        $content = file_get_contents($logFile);

        // Look for password reset email entries
        preg_match_all('/\[(.*?)\] local\.DEBUG: From: (.*?)\nTo: (.*?)\nSubject: (.*?)\n.*?Reset Password: (http:\/\/.*?)\n.*?Message-ID: <(.*?)>/s', $content, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $emails[] = [
                'timestamp' => $match[1],
                'from' => $match[2],
                'to' => $match[3],
                'subject' => $match[4],
                'reset_url' => $match[5],
                'message_id' => $match[6]
            ];
        }
    }

    return view('debug.emails', compact('emails'));
})->name('debug.emails');
