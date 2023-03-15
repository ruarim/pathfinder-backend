<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Helpers\Calculations;
use App\Models\Address;
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
    public function run()
    {
        collect([
            [
                'name' => "The Grace",
                'capacity' => 100,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "00:00",
                'description' => 'Creative pub plates with locally sourced ingredients served in relaxed surrounds with outdoor seats.',
                'address' => [
                    'address_1' => "197 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8BG",
                    'country' => "England",
                ],
                "attributes" => ["Pool", "Real Ale"],
                "beverages" => [
                    [
                        "name" => "Proper Job",
                        "brewery" => "St Austell",
                        "abv" => 5.5,
                        "type" => "Beer",
                        "style" => "IPA",
                        "country" => "England"
                    ],
                    [
                        "name" => "Heineken",
                        "brewery" => "Heineken",
                        "abv" => 5.0,
                        "type" => "Beer",
                        "style" => "Larger",
                        "country" => "Netherlands"
                    ],
                    [
                        "name" => "Doombar",
                        "brewery" => "Sharps",
                        "abv" => 4.0,
                        "type" => "Beer",
                        "style" => "Ale",
                        "country" => "England"
                    ]
                ],
                'images' => ['https://i2-prod.bristolpost.co.uk/incoming/article3761464.ece/ALTERNATES/s615/0_BM_BRI_210120TheGrace_02.jpg'],
                'review' => "Good varied menu served with great beer/wine by engaging, helpful staff.  Go early in the week or in the day as easier to get table without reservation. We'll be back",
                'rating' => 4,
            ],
            [
                'name' => "The Anchor",
                'capacity' => 125,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "22:00",
                'description' => 'Upbeat pub with colourful decor & a patio for classic plates, clever cocktails & draft beer.',
                'address' => [
                    'address_1' => "323 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8PE",
                    'country' => "England",
                ],
                'attributes' => ["Pool", "Real Ale", "Live Sport"],
                'beverages' => [
                    [
                        "name" => "Stella Artois",
                        "brewery" => "Anheuser-Busch InBev",
                        "abv" => 4.6,
                        "type" => "Beer",
                        "style" => "Larger",
                        "country" => "Belgium"
                    ],
                    [
                        "name" => "Mad Goose",
                        "brewery" => "Purity",
                        "abv" => 4.2,
                        "type" => "Beer",
                        "style" => "Pale Ale",
                        "country" => "Netherlands"
                    ],
                    [
                        "name" => "Doombar",
                        "brewery" => "Sharps",
                        "abv" => 4.0,
                        "type" => "Beer",
                        "style" => "Ale",
                        "country" => "England"
                    ]
                ],
                'images' => ['https://static.designmynight.com/uploads/2020/10/anc14-optimised.png'],
                'review' => "Lovely food. 3 of us Couldn't eat the platter. Bar staff very friendly. Pop in if you are local. Recommended.",
                'rating' => 3,
            ],
            [
                'name' => "The Royal Oak",
                'capacity' => 125,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "23:00",
                'description' => 'Family-friendly pub with sofas and a light bar, a terrace and garden, plus wood-fired pizza oven.',
                'address' => [
                    'address_1' => "385 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8TN",
                    'country' => "England",
                ],
                'attributes' => ["Pool", "Real Ale", "Beer Garden", "Live Sport", 'Dog Friendly'],
                'beverages' => [
                    [
                        "name" => "Stella Artois",
                        "brewery" => "Anheuser-Busch InBev",
                        "abv" => 4.6,
                        "type" => "Beer",
                        "style" => "Larger",
                        "country" => "Belgium"
                    ],
                    [
                        "name" => "Proper Job",
                        "brewery" => "St Austell",
                        "abv" => 5.5,
                        "type" => "Beer",
                        "style" => "IPA",
                        "country" => "England"
                    ],
                    [
                        "name" => "Doombar",
                        "brewery" => "Sharps",
                        "abv" => 4.0,
                        "type" => "Beer",
                        "style" => "Ale",
                        "country" => "England"
                    ]
                ],
                'images' => ['https://media-cdn.tripadvisor.com/media/photo-s/0f/a2/ef/ea/warm-and-inviting-bar.jpg'],
                'review' => "Very friendly staff, very helpful. Lovely atmosphere and great very spacious heated and covered gardens.
                They are happy to welcome dogs, so this is definitely Extra Bonus points",
                'rating' => 4,
            ],
            [
                'name' => "The Bristol Flyer",
                'capacity' => 150,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "23:00",
                'description' => 'Huge pub specialising in local ciders and real ales with cosy booth seating and a patio garden.',
                'address' => [
                    'address_1' => "385 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8TN",
                    'country' => "England",
                ],
                'attributes' => ["Real Ale", "Beer Garden", "DJ"],
                'beverages' => [
                    [
                        "name" => "Mad Goose",
                        "brewery" => "Purity",
                        "abv" => 4.2,
                        "type" => "Beer",
                        "style" => "Pale Ale",
                        "country" => "Netherlands"
                    ],
                    [
                        "name" => "Proper Job",
                        "brewery" => "St Austell",
                        "abv" => 5.5,
                        "type" => "Beer",
                        "style" => "IPA",
                        "country" => "England"
                    ],
                    [
                        "name" => "Doombar",
                        "brewery" => "Sharps",
                        "abv" => 4.0,
                        "type" => "Beer",
                        "style" => "Ale",
                        "country" => "England"
                    ]
                ],
                'images' => ['https://www.theflyerbristol.co.uk/content/dam/castle/pub-images/theflyerbristol/theflyerbristol-gallery3.jpg'],
                'review' => "Great Bristol pub for drinking and eating. Excellent staff, very friendly and helpful!",
                'rating' => 5,
            ],
            [
                'name' => "The Prince of Wales",
                'capacity' => 150,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "22:00",
                'description' => 'Classic pub with rustic-style decor offering cask ales and simple food, plus a garden and TV sports.',
                'address' => [
                    'address_1' => "5 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8AA",
                    'country' => "England",
                ],
                'attributes' => ["Real Ale", "Beer Garden"],
                'beverages' => [
                    [
                        "name" => "Stella Artois",
                        "brewery" => "Anheuser-Busch InBev",
                        "abv" => 4.6,
                        "type" => "Beer",
                        "style" => "Larger",
                        "country" => "Belgium"
                    ],
                    [
                        "name" => "Proper Job",
                        "brewery" => "St Austell",
                        "abv" => 5.5,
                        "type" => "Beer",
                        "style" => "IPA",
                        "country" => "England"
                    ],
                    [
                        "name" => "Doombar",
                        "brewery" => "Sharps",
                        "abv" => 4.0,
                        "type" => "Beer",
                        "style" => "Ale",
                        "country" => "England"
                    ]
                ],
                'images' => ['https://i2-prod.bristolpost.co.uk/incoming/article23815.ece/ALTERNATES/s615b/prince-of-wales.jpg'],
                'review' => "Nice friendly staff, Quick service, decent food and a nice chilled vibe.",
                'rating' => 4,
            ],
            [
                "name" => "The Cat and Wheel",
                'capacity' => 150,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "01:00",
                'description' => 'Live music, karaoke and disco, plus sports TV, pool, darts plus a heated beer garden at buzzing pub.',
                'address' => [
                    'address_1' => "207 Cheltenham Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS6 5QX",
                    'country' => "England",
                ],
                "attributes" => ["Live Music", "Beer Garden", "Karaoke",  "Pool", "Darts"],
                "beverages" => [
                    [
                        "name" => "BOB",
                        "brewery" => "Wickwar Wessex",
                        "abv" => 4.6,
                        "type" => "Beer",
                        "style" => "Larger",
                        "country" => "Belgium"
                    ],
                    [
                        "name" => "Black Rat",
                        "brewery" => "Moles Brewery",
                        "abv" => 6.0,
                        "type" => "Cider",
                        "style" => "Dry",
                        "country" => "England"
                    ],
                    [
                        "name" => "Doombar",
                        "brewery" => "Sharps",
                        "abv" => 4.0,
                        "type" => "Beer",
                        "style" => "Ale",
                        "country" => "England"
                    ]
                ],
                'images' => ['https://i2-prod.bristolpost.co.uk/news/bristol-news/article4625885.ece/ALTERNATES/s615/0_Cat-and-Wheel.png'],
                'review' => "Good prices great bar staff and a great buzz about the place.",
                'rating' => 5,
            ],
        ])->each(function ($data) {
            $venue = Venue::firstOrCreate([
                "name" => $data["name"],
                "capacity" => $data["capacity"],
                "venue_type" => $data["venue_type"],
                "opening_time" => $data["opening_time"],
                "closing_time" => $data["closing_time"],
                "description" => $data["description"],
            ]);

            if (!$venue) return;

            $venue->save();

            $has_address = Address::where('venue_id', $venue->id,)->first();
            if ($has_address) $venue->address()->save($has_address);
            else {
                $address_data = $data['address'];
                $venue->setAddress($address_data);
            }

            $attributes_data = $data['attributes'];
            $venue->setAttributes($attributes_data);

            $beverages_data = $data['beverages'];
            $venue->setBeverages($beverages_data);

            $images_urls = $data['images'];
            $venue->setImages($images_urls);

            $content = $data['review'];

            $email = 'seeder@seeder.com';

            $user = User::firstOrCreate([
                'username' => 'James',
                'email' => $email,
                'password' => 'seeder',
                'avatar_url' => 'https://api.dicebear.com/5.x/thumbs/svg?backgroundColor=b6e3f4&seed=' . $email,
            ]);

            //add rating for user
            Rating::firstOrCreate(
                [
                    'rateable_id' => $venue->id,
                    'rateable_type' => Venue::class,
                    'user_id' => $user->id,
                ],
                [
                    'rating' => $data['rating']
                ]
            );

            $ratings = collect($venue->ratings);
            $avg_rating = Calculations::calculate_average_rating($ratings);
            $venue->rating = $avg_rating;

            $venue->save();

            Review::firstOrCreate([
                'user_id' => $user->id,
                'venue_id' => $venue->id,
                'content' => $content,
            ]);

            return $venue;
        });
    }
}
