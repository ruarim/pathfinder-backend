<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Venue;
use Illuminate\Support\Collection;

class Attribute extends Model
{
    protected $fillable = [
        'name',
    ];

    use HasFactory;

    public function venues()
    {
        return $this->belongsToMany(Venue::class);
    }
    public static function fromStrings(array $strings): Collection
    {
        return collect($strings)->map(fn ($str) => trim($str))
            ->unique()
            ->map(fn ($str) => Attribute::firstOrCreate(["name" => $str]));
    }
}
