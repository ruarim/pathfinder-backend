<?php

namespace App\Http\Resources;

use App\Models\Rating;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = User::find($this->user_id);
        $rating = Rating::where('user_id', '=', $this->user_id)
            ->where('rateable_id', '=', $this->venue_id)
            ->where('rateable_type', '=', Venue::class)
            ->first();

        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'content' => $this->content,
            'user' => new UserResource($user),
            'rating' => new RatingResource($rating),
        ];
    }
}
