<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commodity extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'default_unit_id',
        'is_active',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function defaultUnit(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasure::class, 'default_unit_id');
    }

    public function listings(): HasMany
    {
        return $this->hasMany(ProductListing::class);
    }
}
