<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PathResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'startpoint_name' => $this->startpoint_name,
            'startpoint_lat' => $this->startpoint_lat,
            'startpoint_long' => $this->startpoint_long,
            'endpoint_name' => $this->endpoint_name,
            'endpoint_lat' => $this->endpoint_lat,
            'endpoint_long' => $this->endpoint_long,
            'rating' => $this->rating,
            'is_public' => $this->is_public,
            'venues' => VenueResource::collection($this->venues),
            'users' => UserResource::collection($this->users),
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
        ];
    }
}
