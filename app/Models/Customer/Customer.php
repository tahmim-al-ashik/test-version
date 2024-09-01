<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Currency;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_no', 'customer_name', 'customer_type', 'personal_id', 'address', 'postcode', 'city',
        'gln', 'vat_no', 'phone_no', 'mobile_no', 'email_invoice', 'email_cc', 'website',
        'country_id', 'language_id', 'currency_id', 'user_id'
    ];

    public function references()
    {
        return $this->hasMany(Reference::class);
    }

    public function delivery_requirements()
    {
        return $this->hasMany(DeliveryRequirement::class);
    }

    public function payment_requirements()
    {
        return $this->hasMany(PaymentRequirement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

}
