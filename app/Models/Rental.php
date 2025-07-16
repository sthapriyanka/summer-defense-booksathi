<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    // protected $fillable = ['user_id', 'book_id', 'order_item_id', 'rented_at','due_date', 'returned_at', 'status', 'created_at', 'updated_at'];

    protected $guarded = [];
    protected $dates = ['rented_at','due_date', 'returned_at'];

    protected $casts = [
        'rented_at' => 'datetime',
        'due_date' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function getRemainingDaysAttribute()
    {
        $today = Carbon::now();
        return $this->due_date ? $today->diffInDays($this->due_date, true) : 0;
    }

        public function getIsExpiredAttribute()
    {
        return now()->gt($this->due_date);
    }

    public function getPenaltyAttribute()
    {
        return $this->status == 'overdue' ? now()->diffInDays($this->due_date) * 10 : 0;
    }
    public function orderItem() {
        return $this->belongsTo(OrderItems::class);
    }
}
