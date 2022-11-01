<?php

namespace App\Http\Requests;

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
            'name' => 'string|required|max:255',
            'capacity' => 'integer|required',
            'venue_type' => 'string|required|max:255',
            'opening_time' => 'string|required|max:255',
            'closing_time' => 'string|required|max:255',
            'address.address_1' => 'string|required|max:255',
            'address.town_city' => 'string|required|max:255',
            'address.postcode' => 'string|required|max:255',
            'address.country' => 'string|required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A title is required',
            'name' => 'A name is required',
            'capacity' => 'A capacity is required',
            'venue_type' => 'A venue type is required',
            'opening_time' => 'An opening time is required',
            'closing_time' => 'A closing time is required',
            'address.address_1' => 'An address is required',
            'address.town_city' => 'A town is required',
            'address.postcode' => 'A postcode is required',
            'address.country' => 'A country is required',
        ];
    }
}
