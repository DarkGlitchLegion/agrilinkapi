<?php

namespace App\Models\Geography;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmCrop extends Model
{
    protected $fillable = [
        'farm_id',
        'commodity_id',
        'cultivated_area_hectares',
        'planting_date',
        'expected_harvest_date',
        'status',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class);
    }
}
