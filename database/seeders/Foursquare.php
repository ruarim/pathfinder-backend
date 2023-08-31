<?php

namespace Database\Seeders;

use Illuminate\Support\Arr;
use Illuminate\Contracts\Container\BindingResolutionException;

class Foursquare
{
    private $client;
    private $authToken;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $this->authToken = env('FOURSQUARE_SECRET');
    }

    public function getVenues(float $lat, float $long, int $radius, int $limit)
    {
        $categories = '13018';
        $excludeChains = '07841cd9-3716-4bd6-8ebd-ad13070b3125';
        $url = "https://api.foursquare.com/v3/places/search?ll={$lat},{$long}&radius={$radius}&categories={$categories}&sort=DISTANCE&limit={$limit}&exclude_chains={$excludeChains}";

        $response =
            $this
            ->client
            ->request('GET', $url, [
                'headers' => [
                    'Authorization' => $this->authToken,
                    'accept' => 'application/json',
                ],
            ]);

        $body = $response->getBody();
        return json_decode($body, true);
    }

    public function getVenueDetails(string $id)
    {
        $fields = 'photos,tel,website,description,name,features,tastes,hours,rating,tips';
        $url = "https://api.foursquare.com/v3/places/{$id}?fields={$fields}";

        $response =
            $this
            ->client
            ->request('GET', $url, [
                'headers' => [
                    'Authorization' => $this->authToken,
                    'accept' => 'application/json',
                ],
            ]);

        $body = $response->getBody();
        return json_decode($body, true);
    }

    public function buildVenue($venueData, $metadata, int $userId)
    {
        try {
            $name = Arr::get($venueData, "name");
            $venueType = Arr::get($venueData, "categories.0.name");
            $hours = Arr::get($metadata, 'hours.display', '');
            $description = Arr::get($metadata, 'description', '');

            $venue = [
                'user_id' => $userId,
                "name" => $name,
                "venue_type" => $venueType,
                "hours" => $hours,
                "description" => $description,
            ];

            return $venue;
        } catch (BindingResolutionException $e) {
            echo 'Error building venue. Caught exception: ',  $e->getMessage(), "\n";
            return null;
        }
    }

    public function buildAddress($venue)
    {
        try {
            $addressData = Arr::get($venue, 'location');
            $lat = Arr::get($venue, 'geocodes.main.latitude');
            $long = Arr::get($venue, 'geocodes.main.longitude');

            $address = [
                'address_1' => $addressData['address'],
                'town_city' => $addressData['post_town'],
                'postcode' => $addressData['postcode'],
                'country' => $addressData['admin_region'],
                'latitude' => $lat,
                'longitude' => $long,
            ];
            return $address;
        } catch (BindingResolutionException $e) {
            echo 'Error building venue addrress. Caught exception: ',  $e->getMessage(), "\n";
            return null;
        }
    }

    public function buildAttributes($metadata)
    {
        try {
            $attributes = Arr::get($metadata, 'tastes');
            return $attributes;
        } catch (BindingResolutionException $e) {
            echo 'Error building venue attributes. Caught exception: ',  $e->getMessage(), "\n";
            return null;
        }
    }

    public function buildImages($metadata)
    {
        try {
            $imageUrls = [];
            $images = Arr::get($metadata, 'photos');

            foreach ($images as $image) {
                array_push($imageUrls, $image['prefix'] . 'original' . $image['suffix']);
            }

            return $imageUrls;
        } catch (BindingResolutionException $e) {
            echo 'Error building venue images. Caught exception: ',  $e->getMessage(), "\n";
            return null;
        }
    }

    public function buildReviews($metadata)
    {
        try {
            $reviews = Arr::get($metadata, 'tips');
            return $reviews;
        } catch (BindingResolutionException $e) {
            echo 'Error building venue images. Caught exception: ',  $e->getMessage(), "\n";
            return null;
        }
    }

    public function buildRating($metadata)
    {
        try {
            $ratings = Arr::get($metadata, 'rating');

            return $ratings;
        } catch (BindingResolutionException $e) {
            echo 'Error building venue images. Caught exception: ',  $e->getMessage(), "\n";
            return null;
        }
    }
}
