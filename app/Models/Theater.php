<?php

namespace App\Models;

use App\Models\Movie;

use App\Models\MovieShow;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $fillable = [
        'name',
        'city',
        'location',
    ];

    public function movies()
{
    return $this->hasMany(Movie::class);
}

public function shows()
{
    return $this->hasMany(MovieShow::class);
}

}