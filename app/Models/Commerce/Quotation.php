<?php

namespace App\Models\Commerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    protected $fillable = [
        'inquiry_id',
        'farmer_user_id',
        'unit_price',
        'quantity_offered',
        'unit_id',
        'valid_until',
        'terms',
        'status',
    ];

    protected $casts = [
        'valid_until' => 'datetime',
    ];

    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function farmer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'farmer_user_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasure::class, 'unit_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }
}
