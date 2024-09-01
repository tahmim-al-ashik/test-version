<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_id',
        'amount',
        'type', // 'in' or 'out'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
