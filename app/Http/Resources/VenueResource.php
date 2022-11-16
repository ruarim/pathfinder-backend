<?php

namespace App\Http\Resources;

use App\Models\Address;
use Illuminate\Http\Resources\Json\JsonResource;


class VenueResource extends JsonResource
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
            'capacity' => $this->capacity,
            'venue_type' => $this->venue_type,
            'opening_time' => $this->opening_time,
            'closing_time' => $this->closing_time,
            'address' => [
                'address_1' => $this->address->address_1,
                'town_city' => $this->address->town_city,
                'postcode' => $this->address->postcode,
                'country' => $this->address->country
            ],
            'atrributes' => AttributeResource::collection($this->attributes),
            'beverages' => BeverageResource::collection($this->beverages)
        ];
    }
}
