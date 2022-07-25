<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordCheck;

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
            'email' => 'required|email|unique:users',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'password' => ['required', new PasswordCheck ],
            'password_confirmation' => 'required|same:password',
        ];
    }

    public function messages()
     {
        return [
            'password_confirmation|same' => 'Password Confirmation does not match Password.'
        ];
     }
}
