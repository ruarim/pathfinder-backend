<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Attribute;
use Illuminate\Support\Facades\Http;

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
        'description'
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

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function favourites()
    {
        return $this->morphToMany(Favourite::class, 'favouriteable');
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

    public function setAddress(array $address_data): Venue
    {
        //@dev needs error handling
        $address_1 = $address_data['address_1'];
        $city = $address_data['town_city'];
        $country = $address_data['country'];
        $url = "https://nominatim.openstreetmap.org/search?q={$address_1}, {$city}, {$country}&format=json&polygon=1&addressdetails=1";
        $response = Http::get($url)->json()[0];

        $address_data['latitude'] = $response['lat'];
        $address_data['longitude'] = $response['lon'];

        $address = new Address($address_data);
        $this->address()->save($address);
        return $this;
    }
}
