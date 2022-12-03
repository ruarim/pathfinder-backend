<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Venue;

class DatabaseSeeder extends Seeder
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
                'address' => [
                    'address_1' => "197 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8BG",
                    'country' => "England",
                ],
                'atrributes' => ["Pool", "Real Ale"],
                'beverages' => [
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
            ],
            [
                'name' => "The Anchor",
                'capacity' => 125,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "22:00",
                'address' => [
                    'address_1' => "323 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8PE",
                    'country' => "England",
                ],
                'atrributes' => ["Pool", "Real Ale", "Live Sport"],
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
            ],
            [
                'name' => "The Royal Oak",
                'capacity' => 125,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "23:00",
                'address' => [
                    'address_1' => "385 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8TN",
                    'country' => "England",
                ],
                'atrributes' => ["Pool", "Real Ale", "Beer Graden", "Live Sport"],
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
            ],
            [
                'name' => "The Bristol Flyer",
                'capacity' => 150,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "23:00",
                'address' => [
                    'address_1' => "385 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8TN",
                    'country' => "England",
                ],
                'atrributes' => ["Real Ale", "Beer Graden", "DJ"],
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
            ],
            [
                'name' => "The Price of Wales",
                'capacity' => 150,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "22:00",
                'address' => [
                    'address_1' => "5 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8AA",
                    'country' => "England",
                ],
                'atrributes' => ["Real Ale", "Beer Graden"],
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
            ],
            [
                'name' => "The Cat and Wheel",
                'capacity' => 150,
                'venue_type' => 'Pub',
                'opening_time' => '12:00',
                "closing_time" => "01:00",
                'address' => [
                    'address_1' => "5 Gloucester Road",
                    'town_city' => "Bristol",
                    'postcode' => "BS7 8AA",
                    'country' => "England",
                ],
                'atrributes' => ["Live Music", "Beer Graden", "Karaoke",  "Pool", "Darts"],
                'beverages' => [
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
            ],
        ]);
    }
}
