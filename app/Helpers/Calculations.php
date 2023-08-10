<?php

namespace App\Helpers;

class Calculations
{
    public static function calculate_average_rating($ratings): float
    {
        if ($ratings->count() <= 1) {
            return $ratings[0]['rating'];
        }

        $sum = $ratings->reduce(fn ($acc, $val) =>$acc + $val['rating'], 0);
        $total_ratings = $ratings->count();
        return round($sum / $total_ratings, 2);
    }
}
