<?php

namespace App\Models;

use App\Models\Customer\Customer;
use App\Models\Invoice\InvoiceSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'symbol', 'country_id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function invoiceSettings()
    {
        return $this->hasMany(InvoiceSetting::class, 'base_currency_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

}
