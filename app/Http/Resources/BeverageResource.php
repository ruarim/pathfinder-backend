<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BeverageResource extends JsonResource
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
            'name' => $this->name,
            'abv' => $this->abv,
            'type' => $this->type,
            'style' => $this->style,
            'abv' => $this->abv,
            'brewery' => $this->brewery,
            'country' => $this->country,
        ];
    }
}
