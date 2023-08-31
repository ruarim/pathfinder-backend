<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\Attribute;
use App\Models\Image;
use Illuminate\Support\Arr;
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
        'hours',
        'venue_type',
        'description',
        'user_id',
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

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function setAddress(array $addressData): Venue
    {
        $address_1 = $addressData['address_1'];
        $city = $addressData['town_city'];
        $country = $addressData['country'];

        if (!Arr::get($addressData, 'latitude') && !Arr::get($addressData, 'longitude')) {
            try {
                $url = "https://nominatim.openstreetmap.org/search?q={$address_1}, {$city}, {$country}&format=json&polygon=1&addressdetails=1";
                $response = Http::get($url)->json()[0];

                $addressData['latitude'] = $response['lat'];
                $addressData['longitude'] = $response['lon'];
            } catch (\Exception $e) {
                print_r('Error building venue addrress. Caught exception: ' .  $e->getMessage());
            }
        }

        $address = new Address($addressData);
        $this->address()->save($address);
        return $this;
    }

    public function setImages(array $urls): Venue
    {
        Image::fromStrings($urls, $this->id);
        return $this;
    }
}
