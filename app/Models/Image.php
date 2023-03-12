<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'url',
    ];

    public function venue()
    {
        return $this->hasOne(Venue::class);
    }

    public static function fromStrings(array $strings, int $id): Collection
    {
        return collect($strings)->map(fn ($str) => trim($str))
            ->unique()
            ->map(fn ($str) => Image::create([
                "venue_id" => $id,
                "url" => $str
            ]));
    }
}
