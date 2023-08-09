<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\helpers\Calculations;
use App\Models\Rating;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Venue;

class VenueSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    private $client;
    private $seed_locations;
    private $seed_radius;
    private $seed_limit;
    private $auth_token;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
        $env_string = env('SEED_LOCATIONS');
        $this->seed_locations = explode(";", $env_string);
        $this->seed_limit = env('SEED_LIMIT');
        $this->seed_radius = env('SEED_RADIUS');
        $this->auth_token = env('FOURSQUARE_SECRET');
    }

    public function run()
    {
        echo "Seeding venues\n";

        $email = 'seeder@seeder.com';
        $user = User::firstOrCreate([
            'username' => 'James',
            'email' => $email,
            'password' => env('SEEDER_PASSWORD'),
            'avatar_url' => 'https://api.dicebear.com/5.x/thumbs/svg?backgroundColor=b6e3f4&seed=' . $email,
        ]);

        $fully_seeded = 0;
        foreach ($this->seed_locations as $location) {
            $lat_long = explode(",", $location);
            $venues = $this->getVenues($lat_long[0], $lat_long[1], $this->seed_radius, $this->seed_limit)['results'];

            foreach ($venues as $venue) {
                $this->seedVenue($venue, $user->id, $fully_seeded);
            }
        }

        echo "Seeded {$fully_seeded} venues\n";
    }


    //move to requests file
    private function getVenues($lat, $long, $radius, $limit)
    {
        $categories = '13018';
        $exclude_chains = '07841cd9-3716-4bd6-8ebd-ad13070b3125';
        $url = "https://api.foursquare.com/v3/places/search?ll={$lat},{$long}&radius={$radius}&categories={$categories}&sort=DISTANCE&limit={$limit}&exclude_chains={$exclude_chains}";

        $response = $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->auth_token,
                'accept' => 'application/json',
            ],
        ]);

        $body = $response->getBody();
        return json_decode($body, true);
    }

    private function getVenueDetails(string $id)
    {
        $fields = 'photos,tel,website,description,name,features,tastes,hours,rating,tips';
        $url = "https://api.foursquare.com/v3/places/{$id}?fields={$fields}";

        $response = $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => $this->auth_token,
                'accept' => 'application/json',
            ],
        ]);

        $body = $response->getBody();
        return json_decode($body, true);
    }

    private function seedVenue($venue_data, $user_id, &$fully_seeded)
    {
        echo "Seeding {$venue_data['name']}...\n";

        $fsq_id = $venue_data['fsq_id'];
        $venue_details = $this->getVenueDetails($fsq_id);

        $name = $venue_data["name"];
        $venue_type = $venue_data["categories"][0]['name'];

        $hours = '';
        $hours_data = $venue_details['hours'];
        if (key_exists('display', $hours_data)) $hours = $hours_data['display'];

        $description = '';
        if (key_exists('description', $venue_details)) $description = $venue_details['description'];

        $venue_model = Venue::firstOrCreate([
            'user_id' => $user_id,
            "name" => $name,
            "venue_type" => $venue_type,
            "hours" => $hours,
            "description" => $description,
        ]);

        if (!$venue_model) return;
        $venue_model->save();

        $this->seedAddress($venue_data, $venue_model);

        if (!key_exists('tastes', $venue_details)) return;
        $attributes = $venue_details['tastes'];
        $this->seedAttributes($attributes, $venue_model);

        $image_urls = [];

        $images = $venue_details['photos'];
        foreach ($images as $image) {
            array_push($image_urls, $image['prefix'] . 'original' . $image['suffix']);
        }
        $venue_model->setImages($image_urls);

        if (!key_exists('tips', $venue_details)) return;
        $reviews = $venue_details['tips'];

        foreach ($reviews as $review) {
            $this->seedReview($review['text'], $venue_model);
        }

        $rating = $venue_details['rating'];
        $this->seedRating($rating, $venue_model, $user_id);

        $fully_seeded++;
        echo "Seeded {$venue_model->name}\n";
    }

    private function seedAddress($venue_data, $venue_model)
    {
        $address_data = $venue_data['location'];
        $lat = $venue_data['geocodes']['main']['latitude'];
        $long = $venue_data['geocodes']['main']['longitude'];

        $address_exists = Address::where('venue_id', $venue_model->id,)->first();
        if ($address_exists) $venue_model->address()->save($address_exists);
        else {
            $address_data = [
                'venue_id' => $venue_model->id,
                'address_1' => $address_data['address'],
                'town_city' => $address_data['post_town'],
                'postcode' => $address_data['postcode'],
                'country' => $address_data['admin_region'],
                'latitude' => $lat,
                'longitude' => $long,
            ];
            $venue_model->setAddress($address_data);
        }
    }

    private function seedAttributes($attributes, $venue_model)
    {
        $venue_model->setAttributes($attributes);
    }

    private function seedReview($review, $venue_model)
    {
        $user = $this->fakeUser();
        Review::firstOrCreate([
            'user_id' => $user->id,
            'venue_id' => $venue_model->id,
            'content' => $review,
        ]);
    }

    private function seedRating($rating, $venue_model)
    {
        $user = $this->fakeUser();

        Rating::firstOrCreate(
            [
                'rateable_id' => $venue_model->id,
                'rateable_type' => Venue::class,
                'user_id' => $user->id,
            ],
            [
                'rating' => $rating / 2
            ]
        );

        $ratings = collect($venue_model->ratings);
        $avg_rating = Calculations::calculate_average_rating($ratings);
        $venue_model->rating = $avg_rating;
    }

    private function fakeUser()
    {
        $faker = \Faker\Factory::create();
        $email = $faker->email;
        $name = $faker->name;
        $password = $faker->password;

        $user = User::firstOrCreate([
            'username' => $name,
            'email' => $email,
            'password' => $password,
            'avatar_url' => 'https://api.dicebear.com/5.x/thumbs/svg?backgroundColor=b6e3f4&seed=' . $email,
        ]);

        return $user;
    }
}
