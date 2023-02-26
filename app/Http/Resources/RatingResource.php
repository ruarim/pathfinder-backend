<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $model = $this->rateable_type;

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'rating' => [
                'average_rating' => $model::find($this->rateable_id)->rating,
                'my_rating' => $this->rating
            ],
        ];
    }
}
