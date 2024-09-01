<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'postal_code',
        'zip_code',
        'country',
        'city',
        'logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

##########Http->Model->CorporateUser.php###############
