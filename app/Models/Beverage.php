<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Beverage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abv',
        'type', //beer, cider, spirit, mixed drink, wine
        'style', //wine{red, white, port, sparking} beer{lager, bitter, stout, ale} spirit{dark rum, white rum, vodka, cognac}, cocktail, spirit mixer
        'brewery',
        'country',
    ];

    public function venues()
    {
        return $this->belongsToMany(Venue::class);
    }

    public static function fromArray(array $beverages): Collection
    {
        $data = collect($beverages)->map(fn ($beverage) => $beverage)
            ->unique()
            ->map(fn ($obj) => Beverage::firstOrCreate([
                "name" => $obj['name'],
                "brewery" => $obj['brewery'],
                "type" => $obj['type'],
                "abv" => $obj['abv'],
                "style" => $obj['style'],
                "country" => $obj['country']
            ]));
        return $data;
    }
}
