<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 'name', 'description', 'price', 'discount', 'image'
    ];

    ########### relationship between services and packages ##########

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_services');
    }
}

##########Http->Model->Admin->Package.php###############
