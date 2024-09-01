<?php

namespace App\Models\Customer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentRequirement extends Model
{
    use HasFactory;

    protected $fillable = ['terms_of_payment', 'currency', 'pay_to_account', 'customer_discount', 'user_id', 'customer_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
