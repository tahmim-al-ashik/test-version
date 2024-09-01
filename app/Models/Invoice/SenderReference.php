<?php

namespace App\Models\Invoice;


use App\Models\Invoice\InvoiceSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenderReference extends Model
{

    use HasFactory;

    protected $fillable = [
        'invoice_setting_id',
        'name',
        'email',
        'phone_number',
    ];

    public function invoiceSetting()
    {
        return $this->belongsTo(InvoiceSetting::class);
    }
}
