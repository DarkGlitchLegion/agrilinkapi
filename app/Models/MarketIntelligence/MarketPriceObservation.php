<?php

namespace App\Models\MarketIntelligence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MarketPriceObservation extends Model
{
    protected $fillable = [
        'commodity_id',
        'market_id',
        'source_id',
        'price_type',
        'minimum_price',
        'maximum_price',
        'average_price',
        'unit_id',
        'observed_on',
        'published_at',
        'verification_status',
        'submitted_by',
    ];

    protected $casts = [
        'observed_on' => 'date',
        'published_at' => 'datetime',
    ];

    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class);
    }

    public function market(): BelongsTo
    {
        return $this->belongsTo(Market::class);
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(DataSource::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasure::class, 'unit_id');
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }
}
