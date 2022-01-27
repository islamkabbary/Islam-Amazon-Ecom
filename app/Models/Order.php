<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'total',
        'paid',
        'note',
        'sub_total',
        'discount_value',
        'user_id',
        'coupon_id',
        'driver_id',
    ];

    public static function boot(){
        parent::boot();
        self::creating(function($model){
            $model->user_id = Auth::id();
        });
    }
    /**
     * Get the driver that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * The products that belong to the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'oreder_items', 'order_id', 'product_id')->withPivot('qty','price');
    }
}
