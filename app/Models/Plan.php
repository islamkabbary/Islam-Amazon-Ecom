<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'features', 'plan_id', 'stripe_plan_id'
    ];

    /**
     * Get all of the prices for the Plan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(PricePlan::class, 'plan_id');
    }
}
