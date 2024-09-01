<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user()->id,
            'bio' => 'nullable|string',
            'password' => 'nullable|string|min:8',
            'new_password' => 'nullable|string|min:8|confirmed',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->filled('password') && !Hash::check($this->password, $this->user()->password)) {
                $validator->errors()->add('password', 'The provided password does not match your current password.');
            }
        });
    }
}
