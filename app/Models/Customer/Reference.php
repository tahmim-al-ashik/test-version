<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Reference extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone_no', 'mobile_no', 'customer_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
