<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'favouriteable_id',
        'favouriteable_type',
    ];

    public function favouriteable()
    {
        return $this->morphTo();
    }
}
