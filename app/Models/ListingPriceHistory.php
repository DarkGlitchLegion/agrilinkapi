<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingPriceHistory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_listing_id',
        'old_price',
        'new_price',
        'changed_by',
        'changed_at',
    ];

    protected $casts = [
        'changed_at' => 'datetime',
    ];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(ProductListing::class);
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
