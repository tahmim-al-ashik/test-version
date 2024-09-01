<?php

namespace App\Models\Invoice;

use App\Models\Invoice\SenderReference;
use App\Models\Currency;
use App\Models\Customer\Reference;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'company_person_name',
        'emails',
        'phones',
        'base_currency_id',
        'address',
        'website',
        'social_media_links',
        'invoice_created_by',
        'logo_path',
        'watermark_logo_path',
        'sender_references',
    ];

    protected $casts = [
        'emails' => 'array',
        'phones' => 'array',
        'social_media_links' => 'array',
        'sender_references' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'base_currency_id');
    }
    public function references()
    {
        return $this->hasMany(Reference::class);
    }
    public function senderReferences()
    {
        return $this->hasMany(SenderReference::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'invoice_setting_id');
    }
}
