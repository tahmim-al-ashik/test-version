<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\Auth\UserRole;
use App\Models\Admin\Service;
use App\Models\Admin\Package;
use App\Models\Invoice\InvoiceSetting;
use App\Models\CorporateUser;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'additional_email',
        'postal_code',
        'zip_code',
        'country',
        'city',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => UserRole::class,
    ];

////call user role from enum
    // public function isAdmin(): bool
    // {
    //     return $this->role === UserRole::Admin;
    // }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'user_services')
            ->withPivot('package_id', 'registration_type', 'created_at'); // Add registration_type and created_at to pivot
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'user_services')
            ->withPivot('service_id', 'registration_type', 'created_at'); // Add registration_type and created_at to pivot
    }

    public function corporateRegistrations()
    {
        return $this->hasMany(CorporateUser::class);
    }
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
    public function invoiceSetting()
    {
        return $this->hasOne(InvoiceSetting::class);
    }


}

##########Http->Model->User.php###############
