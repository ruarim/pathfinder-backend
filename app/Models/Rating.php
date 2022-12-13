<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'user_id',
        'rateable_id',
        'rateable_type',
    ];

    public function rateable()
    {
        return $this->morphTo();
    }
}
