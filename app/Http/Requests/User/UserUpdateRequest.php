<?php

namespace App\Http\Requests\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->route('user')->id],
            'phone' => ['required', 'string', 'max:255', 'unique:users,phone,' . $this->route('user')->id],
            'password' => ['nullable', 'string', 'min:8'],
        ];
    }
}
