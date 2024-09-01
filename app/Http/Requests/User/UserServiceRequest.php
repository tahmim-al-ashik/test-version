<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // Determine the validation rules based on the registration type
        if ($this->routeIs('services.store.personal')) {
            return [
                'package_id' => 'required|exists:packages,id',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'nullable|string|max:255',
                'additional_email' => 'nullable|string|email|max:255',
                'postal_code' => 'nullable|string|max:255',
                'zip_code' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
            ];
        } elseif ($this->routeIs('services.store.corporate')) {
            return [
                'package_id' => 'required|exists:packages,id',
                'name' => 'required|string|max:255',
                'phone' => 'nullable|string|max:255',
                'postal_code' => 'nullable|string|max:255',
                'zip_code' => 'nullable|string|max:255',
                'country' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:255',
                'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ];
        }
        return [];
    }
}
