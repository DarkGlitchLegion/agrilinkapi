<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UnitOfMeasure extends Model
{
    protected $fillable = [
        'name',
        'symbol',
        'unit_type',
        'is_active',
    ];

    public function commodities(): HasMany
    {
        return $this->hasMany(Commodity::class, 'default_unit_id');
    }

    public function listings(): HasMany
    {
        return $this->hasMany(ProductListing::class, 'unit_id');
    }
}
