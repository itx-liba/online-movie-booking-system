<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\MovieShow;

use App\Models\Review;


class Movie extends Model
{
     // Fields that can be filled when creating or updating a movie

    protected $fillable = [
        'theater_id',
        'title',
        'description',
        'genre',
        'duration',
        'release_date',
        'poster',
        'trailer_url',
        'rating',
    ];

     // A movie belongs to one theater

    public function theater()
    {
        return $this->belongsTo(Theater::class);
    }

     // A movie can have many show timings

    public function shows()
{
    return $this->hasMany(MovieShow::class);
}

 // A movie can have many user reviews

   public function reviews()
{
    return $this->hasMany(Review::class);
}

}