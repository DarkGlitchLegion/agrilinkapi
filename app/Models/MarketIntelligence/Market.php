<?php

namespace App\Models\MarketIntelligence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Market extends Model
{
    protected $fillable = [
        'name',
        'market_type',
        'barangay_id',
        'address',
        'latitude',
        'longitude',
        'is_active',
    ];

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class);
    }

    public function priceObservations(): HasMany
    {
        return $this->hasMany(MarketPriceObservation::class);
    }
}
