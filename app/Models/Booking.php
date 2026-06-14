<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Fields that can be filled when creating or updating a booking.

    protected $fillable = [
        'user_id',
        'movie_show_id',
        'seat_class',
        'adult_tickets',
        'kids_tickets',
        'total_amount',
        'status',
    ];

    // A booking belongs to one user

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A booking belongs to one movie show.

    public function movieShow()
    {
        return $this->belongsTo(MovieShow::class);
    }
}