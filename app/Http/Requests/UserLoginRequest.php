<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    // Validation
    public function rules(): array
    {
        return [
            'email' => ['required', 'email' , 'string' , 'max:255'],
            'password' => ['required'],
        ];
    }

}
