<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductListing extends Model
{
    protected $fillable = [
        'farm_id',
        'commodity_id',
        'title',
        'description',
        'variety',
        'quality_grade',
        'quantity_available',
        'unit_id',
        'minimum_order_quantity',
        'price_per_unit',
        'pricing_type',
        'harvest_date',
        'available_until',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'harvest_date' => 'date',
        'available_until' => 'date',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasure::class, 'unit_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function priceHistory(): HasMany
    {
        return $this->hasMany(ListingPriceHistory::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(ListingReport::class);
    }
}
