<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venue;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'address_1',
        'address_2',
        'town_city',
        'postcode',
        'country',
        'latitude',
        "longitude",
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
