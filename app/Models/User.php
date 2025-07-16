<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'last_login_at' => 'datetime',
        ];
    }
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function wishlistedBooks()
    {
        return $this->belongsToMany(Book::class, 'wishlists');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function rentedBooks()
    {
        return $this->belongsToMany(Book::class, 'rentals');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function profilePicture()
    {
        return "https://ui-avatars.com/api/?name=" . join('+', explode(' ', $this->name)) . "&background=dcfce7&color=15803d&font-size=0.33";
    }

    public function getIsActiveAttribute()
    {
        return $this->last_login_at >= now()->subDays(90);
    }

    public function scopeActive()
    {
        return $this->where('last_login_at', '>=', now()->subDays(90));
    }

    public function scopeInactive()
    {
        return $this->where('last_login_at', '<=', now()->subDays(90));
    }

    public function scopeNew()
    {
        return $this->where('created_at', '>=', now()->subDays(30));
    }

    public function favoriteGenres($limit = 3)
    {
        $userId = $this->id;

        $rentalGenres = DB::table('rentals')
            ->join('books_genres', 'rentals.book_id', '=', 'books_genres.book_id')
            ->join('genres', 'books_genres.genre_id', '=', 'genres.id')
            ->where('rentals.user_id', $userId)
            ->select('genres.id', 'genres.name', DB::raw('count(*) as total'))
            ->groupBy('genres.id', 'genres.name');

        $wishlistGenres = DB::table('wishlists')
            ->join('books_genres', 'wishlists.book_id', '=', 'books_genres.book_id')
            ->join('genres', 'books_genres.genre_id', '=', 'genres.id')
            ->where('wishlists.user_id', $userId)
            ->select('genres.id', 'genres.name', DB::raw('count(*) as total'))
            ->groupBy('genres.id', 'genres.name');

        // Union both and sum the totals
        $genres = DB::table(DB::raw("({$rentalGenres->toSql()}) as rental_genres"))
            ->mergeBindings($rentalGenres)
            ->unionAll(
                DB::table(DB::raw("({$wishlistGenres->toSql()}) as wishlist_genres"))
                    ->mergeBindings($wishlistGenres)
            );

        // Wrap again to group by genre and sum totals from both sources
        return DB::table(DB::raw("({$genres->toSql()}) as combined_genres"))
            ->mergeBindings($genres)
            ->select('id', 'name', DB::raw('sum(total) as total'))
            ->groupBy('id', 'name')
            ->orderByDesc('total')
            ->limit($limit)
            ->get();
    }
}
