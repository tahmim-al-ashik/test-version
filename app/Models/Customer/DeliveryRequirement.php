<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRequirement extends Model
{
    use HasFactory;

    protected $fillable = ['terms_of_delivery', 'delivery_method', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
