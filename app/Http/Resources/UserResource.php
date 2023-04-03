<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username' => $this->username,
            'email' => $this->email,
            'avatar_url' => $this->avatar_url,
            'is_admin' => $this->is_admin,
            'is_creator' => $this->whenPivotLoaded('path_user', function () {
                return $this->pivot->is_creator;
            }),
            'has_completed' => $this->whenPivotLoaded('path_user', function () {
                return $this->pivot->has_completed;
            }),
        ];
    }
}
