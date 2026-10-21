<?php

namespace App\Models\MarketIntelligence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataSource extends Model
{
    protected $fillable = [
        'name',
        'source_type',
        'source_url',
        'publisher',
        'license_notes',
        'is_active',
    ];

    public function priceObservations(): HasMany
    {
        return $this->hasMany(MarketPriceObservation::class);
    }

    public function importBatches(): HasMany
    {
        return $this->hasMany(PriceImportBatch::class);
    }
}
