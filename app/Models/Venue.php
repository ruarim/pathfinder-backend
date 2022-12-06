<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Attribute;

class Venue extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'capacity',
        'opening_time',
        'closing_time',
        'venue_type',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function beverages()
    {
        return $this->belongsToMany(Beverage::class);
    }

    public function setAttributes(array $strings): Venue
    {
        $attributes = Attribute::fromStrings($strings);
        $this->attributes()->sync($attributes->pluck("id"));

        return $this;
    }

    public function setBeverages(array $strings): Venue
    {
        $beverages = Beverage::fromArray($strings);
        $this->beverages()->sync($beverages->pluck("id"));

        return $this;
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }
}
