<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class VenueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "string|required",
            "capacity" => "integer|required",
            "venue_type" => "string|required",
            "opening_time" => "string|required",
            "closing_time" => "string|required",
            "address.address_1" => "string|required",
            "address.address_2" => "string",
            "address.town_city" => "string|required",
            "address.postcode" => "string|required",
            "address.country" => "string|required",
        ];
    }
}

//EXAMPLE REQUEST
// {
//     "name": "Golden Lion",
//     "capacity": 150,
//     "venue_type": "Pub",
//     "opening_time": "17:30",
//     "closing_time": "00:00",
//     "address": {
//         "address_1": "224 Gloucester Road",
//         "town_city": "Bristol",
//         "postcode": "BS7 8NZ",
//         "country": "England"
//     }
// }
