<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beverage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brewer',
        'abv',
        'type',
        'country',
        'region',
        'style',
        'producer'
    ];

    public function venues()
    {
        return $this->belongsToMany(Venue::class);
    }
}
