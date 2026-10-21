<?php

namespace App\Models\Geography;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barangay extends Model
{
    protected $fillable = [
        'municipality_id',
        'name',
        'code',
        'is_active',
    ];

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }
}
