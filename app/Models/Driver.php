<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use function PHPUnit\Framework\returnSelf;

class Driver extends Authenticatable implements JWTSubject
{
    use HasFactory;
    
    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->store_id = Auth::id();
        });
    }

    public function setPasswordAttribute($value){
        return $this->attributes['password'] = Hash::make($value);
    }

    protected $fillable =['name','email','password','location','store_id'];
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
     * Get the store that owns the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    /**
     * Get all of the orders for the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function notifications()
    {
        return $this->morphToMany(Notification::class,'notificationable');
    }
}
