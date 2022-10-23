<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
            'first_name' => ['required','string','max:255'],
            'last_name' => ['required','string','max:255'],
            'username' => ['required','string','max:255'],
            'email' => ['email' => 'required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => Password::min(8)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()
        ];
    }
}
