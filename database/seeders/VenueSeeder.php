<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Helpers\Calculations;
use App\Models\Rating;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Venue;
use Database\Seeders\Metadata\Foursquare;

class VenueSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    private $seedLocations;
    private $seedRadius;
    private $seedLimit;
    private $foursquare;


    public function __construct()
    {
        $env_string = env('SEED_LOCATIONS');
        $this->seedLocations = explode(";", $env_string);
        $this->seedRadius = env('SEED_RADIUS');
        $this->seedLimit = env('SEED_LIMIT');
        $this->foursquare = new Foursquare();
    }

    public function run()
    {
        echo "Seeding venues\n";

        $user = $this->seedUser();
        $totalSeeded = 0;

        foreach ($this->seedLocations as $location) {
            $latLong = explode(",", $location);
            echo 'Seeding location: ' . "lat: {$latLong[0]}, long: {$latLong[1]}\n";

            $venues = $this->foursquare->getVenues(
                $latLong[0],
                $latLong[1],
                $this->seedRadius,
                $this->seedLimit
            )['results'];

            foreach ($venues as $venue) {
                echo "Seeding {$venue['name']}...\n";
                $metadata = $this->foursquare->getVenueDetails($venue['fsq_id']);

                $model = $this->seedVenue(
                    $venue,
                    $metadata,
                    $user->id
                );

                $this->seedAddress(
                    $venue,
                    $model
                );

                $this->seedAttributes(
                    $metadata,
                    $model
                );

                $this->seedImages(
                    $metadata,
                    $model
                );

                $this->seedReviews(
                    $metadata,
                    $model
                );

                $this->seedRating(
                    $metadata,
                    $model,
                );

                $totalSeeded++;
                echo "Seeded {$model->name}\n";
            }
        }

        echo "Seeded {$totalSeeded} venues\n";
    }

    private function seedVenue($venue, $metadata, $userId)
    {
        $venueData = $this->foursquare->buildVenue(
            $venue,
            $metadata,
            $userId
        );
        if (!$venueData) return null;

        $model = Venue::firstOrCreate($venueData);
        return $model;
    }

    private function seedAddress($venueData, $model)
    {
        $existingAddress = Address::where(
            'venue_id',
            $model->id,
        )->first();

        if ($existingAddress)
            $model->address()->save($existingAddress);
        else {
            $address = $this->foursquare->buildAddress($venueData);
            if (!$address) return null;
            $address['venue_id'] = $model->id;
            $model->setAddress($address);
        }
    }

    private function seedAttributes($metadata, $model)
    {
        $attributes = $this->foursquare->buildAttributes($metadata);
        if (!$attributes) return null;

        $model->setAttributes($attributes);
    }

    private function seedImages($metadata, $model)
    {
        $images = $this->foursquare->buildImages($metadata);
        if (!$images) return null;

        $model->setImages($images);
    }

    private function seedReviews($metadata, $model)
    {
        $reviews = $this->foursquare->buildReviews($metadata);

        if (!$reviews) return null;

        foreach ($reviews as $review) {
            $user = $this->fakeUser();
            Review::firstOrCreate([
                'user_id' => $user->id,
                'venue_id' => $model->id,
                'content' => $review['text'],
            ]);
        }
    }

    private function seedRating($metadata, $model)
    {
        $rating = $this->foursquare->buildRating($metadata);
        if (!$rating) return null;

        $user = $this->fakeUser();

        Rating::firstOrCreate(
            [
                'rateable_id' => $model->id,
                'rateable_type' => Venue::class,
                'user_id' => $user->id,
            ],
            [
                'rating' => $rating / 2
            ]
        );

        $ratings = collect($model->ratings);
        $avg_rating = Calculations::calculate_average_rating($ratings);
        $model->rating = $avg_rating;
        $model->save();
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

    private function seedUser()
    {
        $email = 'seeder@seeder.com';
        $user = User::firstOrCreate(
            [
                'username' => 'James',
                'email' => $email,
                'password' => env('SEEDER_PASSWORD'),
                'avatar_url' => 'https://api.dicebear.com/5.x/thumbs/svg?backgroundColor=b6e3f4&seed=' . $email,
            ]
        );
        return $user;
    }
}
