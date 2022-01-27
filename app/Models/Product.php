<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\User;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'description',
        'qty',
        'category_id',
        'store_id',
    ];

    /**
     * Get the category that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id' ,'id');
    }

    /**
     * Get the store that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo(Store::class,'store_id' , 'id');
    }

    /**
     * The roles that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, Cart::class ,'product_id' ,'user_id')->withPivot('qty');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'products_has_offers' ,'offer_id' ,'product_id');
    }

    /**
     * The orders that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'oreder_items', 'order_id', 'product_id')->withPivot('qty','price');
    }
}
