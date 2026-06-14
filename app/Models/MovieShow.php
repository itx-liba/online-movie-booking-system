<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Booking;

class MovieShow extends Model
{
    // Fields that can be filled when creating or updating a movie show

    protected $fillable = [
        'movie_id',
        'theater_id',
        'show_date',
        'show_time',
        'gold_rate',
        'platinum_rate',
        'box_rate',
    ];

     // A movie show belongs to one movie

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

     // A movie show belongs to one theater

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

     // A movie show can have many bookings.

    public function bookings()
{
    return $this->hasMany(Booking::class);
}
}