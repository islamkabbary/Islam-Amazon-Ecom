<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsToMany(Product::class, 'products_has_offers' ,'offer_id' ,'product_id');
    }
}
