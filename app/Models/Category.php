<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'categories';
    protected $fillable = ['name','status','parent_id'];
   
    // protected $guarded = ['id'];
    // protected $casts = ["status" => "boolean"];
    // protected $primaryKey = 'id';
    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function (Model $model) {
    //         $model->setAttribute($model->getKeyName(), Uuid::uuid4());
    //     });
    // }
    // public function setNameAttribute($value){
    //     return $this->attributes["name"] = "sta".$value;
    // }
    /***********************************************************************************
     

    /**
     * Get all of the products for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class , "category_id" , 'id');
    }
    

    /**
     * Get all of the childrens for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the parent that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
