<?php

namespace App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'cover_image'
    ];
########### relationship between packages and services ##########
    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_services');
    }
}
##########Http->Model->Admin->service.php###############
