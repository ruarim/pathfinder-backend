<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
                'first_name' => 'string|max:255',
                'last_name' => 'string|max:255',
                'username' => 'string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'string|max:255',
            ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email address provided is already in use.',
        ];
    }
}
