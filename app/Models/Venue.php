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
        'rating',
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

    public function setBeverages(array $strings): Venue //change to beverages
    {
        $beverages = Beverage::fromArray($strings);
        $this->beverages()->sync($beverages->pluck("id"));

        return $this;
    }

    public function setAddress(array $address_data): Venue
    {
        //create params from address_data
        $address1 = $address_data['address1'];
        $city = $address_data['city'];
        $country = $address_data['country'];
        $response = Http::get('https://nominatim.openstreetmap.org/search?q="13+fernbank+road,+bristol&format=json&polygon=1&addressdetails=1');

        $address_data['latitude'] = $response->json()['lat'];
        $address_data['longitude'] = $response->json()['lon'];

        dd($address_data);
        $address = new Address($address_data);
        $this->address()->save($address);
        return $this;
    }
}
