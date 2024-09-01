<?php

namespace App\Models\Invoice;

use App\Models\Customer\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'user_id',
        'customer_id',
        'invoice_category_id',
        'invoice_setting_id',
        'invoice_date',
        'delivery_date',
        'products',
        'notes',
        'payment_details',
        'qr_link',
        'file_path',
        'status',
        'total_price_excluding_vat',
        'total_price_including_vat',
        'received_money',
        'transaction_type',
        'due_amount',

    ];

    protected $casts = [
        'products' => 'array',
        'invoice_date' => 'date',
        'delivery_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function invoiceCategory()
    {
        return $this->belongsTo(InvoiceCategory::class);
    }

    public function invoiceSetting()
    {
        return $this->belongsTo(InvoiceSetting::class, 'invoice_setting_id');
    }
}
