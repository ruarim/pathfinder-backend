<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'venue_id',
        'content'
    ];

    public function users()
    {
        $this->belongsTo(User::class);
    }
    public function venues()
    {
        $this->belongsTo(Venue::class);
    }
}
