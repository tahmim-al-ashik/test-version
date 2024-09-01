<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'subcategory' => 'nullable|string|max:255',
            'price_including_vat' => 'nullable|numeric|min:0',
            'price_excluding_vat' => 'nullable|numeric|min:0',
            'instock' => 'nullable|integer|min:0',
        ];
    }
}
