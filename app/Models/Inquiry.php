<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inquiry extends Model
{
    protected $fillable = [
        'buyer_user_id',
        'product_listing_id',
        'requested_quantity',
        'unit_id',
        'message',
        'status',
    ];

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_user_id');
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(ProductListing::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitOfMeasure::class, 'unit_id');
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }
}
