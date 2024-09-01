<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        // Assuming all authenticated users can create a customer.
        return auth()->check();
    }

    public function rules()
    {
        return [
            'customer_name' => 'required|string|max:255',
            'customer_type' => 'required|string|max:255',
            'personal_id' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'language_id' => 'required|exists:languages,id',
            'currency_id' => 'required|exists:currencies,id',
            'phone_no' => 'nullable|string|max:255',
            'mobile_no' => 'nullable|string|max:255',
            'email_invoice' => 'nullable|email|max:255',
            'email_cc' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'gln' => 'nullable|string|max:255',
            'vat_no' => 'nullable|string|max:255',
            'references.*.name' => 'required|string|max:255',
            'references.*.email' => 'required|email|max:255',
            'references.*.phone_no' => 'required|string|max:255',
            'references.*.mobile_no' => 'required|string|max:255',
            'delivery_requirements.*.terms_of_delivery' => 'required|string|max:255',
            'delivery_requirements.*.delivery_method' => 'required|string|max:255',
            'payment_requirements.*.terms_of_payment' => 'required|string|max:255',
            'payment_requirements.*.currency' => 'required|string|max:255',
            'payment_requirements.*.pay_to_account' => 'required|string|max:255',
            'payment_requirements.*.customer_discount' => 'required|numeric|min:0|max:100',
        ];
    }
}
