<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'serviceName' => 'required|string|max:255',
            'serviceDescription' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'packages' => 'nullable|array',
            'packages.*.name' => 'nullable|string|max:255',
            'packages.*.price' => 'nullable|numeric',
            'packages.*.discount' => 'nullable|numeric',
            'packages.*.description' => 'nullable|array',
            'packages.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}

##########Http->Request->Admin->ServicesRequest.php###############
