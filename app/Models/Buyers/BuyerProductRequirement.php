<?php

namespace App\Models\Buyers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuyerProductRequirement extends Model
{
    protected $fillable = [
        'buyer_profile_id',
        'commodity_id',
        'quantity_required',
        'unit_id',
        'target_price',
        'needed_by',
        'delivery_barangay_id',
        'status',
    ];

    protected $casts = [
        'needed_by' => 'date',
    ];

    public function buyerProfile(): BelongsTo
    {
        return $this->belongsTo(BuyerProfile::class);
    }

    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasure::class, 'unit_id');
    }

    public function deliveryBarangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class, 'delivery_barangay_id');
    }
}
