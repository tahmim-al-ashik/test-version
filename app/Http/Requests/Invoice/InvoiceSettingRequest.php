<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceSettingRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }
    public function rules()
    {
        return [
            'company_person_name' => 'required|string|max:255',
            'emails' => 'array',
            'emails.*' => 'email',
            'phones' => 'array',
            'phones.*' => 'string|max:20',
            'base_currency_id' => 'required|exists:currencies,id',
            'address' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'social_media_links' => 'array',
            'social_media_links.*' => 'url',
            'invoice_created_by' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'watermark_logo' => 'nullable|image|max:2048',
            'sender_references' => 'array',
            'sender_references.*.name' => 'required|string|max:255',
            'sender_references.*.email' => 'required|email|max:255',
            'sender_references.*.phone' => 'required|string|max:20',
            'package_id' => 'required|integer',
        ];
    }
}
