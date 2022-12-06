<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'rateable_id',
        'rateable_type',
    ];

    public function rateable()
    {
        return $this->morphTo();
    }

    public function calculate_average_rating($ratings): float
    {
        $sum = $ratings->reduce(fn ($acc, $val) =>$acc + $val['rating'], 0);
        $total_ratings = $ratings->count();
        return round($sum / $total_ratings, 2);
    }
}
