<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{

 function authorize(): bool
    {
        return true;
    }

    // Validation
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:users,phone'],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    // Messages
    public function messages(): array
    {
        return [
            'email.required' => __('validation.required', ['attribute' => __('validation.attributes.email')]),
            'phone.required' => __('validation.required', ['attribute' => __('validation.attributes.phone')]),
            'email.email' => __('validation.email', ['attribute' => __('validation.attributes.email')]),
            'email.max' => __('validation.max.string', ['attribute' => __('validation.attributes.email'), 'max' => 255]),
            'password.required' => __('validation.required', ['attribute' => __('validation.attributes.password')]),
        ];
    }
    // Attribute
    public function attributes(): array
    {
        return [
            'name' => __('validation.attributes.name'),
            'email' => __('validation.attributes.email'),
            'phone' => __('validation.attributes.phone'),
            'password' => __('validation.attributes.password'),
        ];
    }
}

