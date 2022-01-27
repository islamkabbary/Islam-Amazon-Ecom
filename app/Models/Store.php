<?php

namespace App\Models;

use App\Models\Product;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Store extends Authenticatable implements JWTSubject
{
    use HasFactory;

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

    /**
     * Get all of the products for the Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get all of the drivers for the Store
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class);
    }

    public function notifications()
    {
        return $this->morphToMany(Notification::class,'notificationable');
    }
}
