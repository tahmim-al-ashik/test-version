<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function currencies(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Currency::class);
    }
}
