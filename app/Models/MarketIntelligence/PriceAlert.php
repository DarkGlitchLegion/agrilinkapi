<?php

namespace App\Models\MarketIntelligence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceAlert extends Model
{
    protected $fillable = [
        'user_id',
        'commodity_id',
        'barangay_id',
        'target_price',
        'comparison_operator',
        'is_active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class);
    }

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class);
    }
}
