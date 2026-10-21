<?php

namespace App\Models\Commerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'buyer_user_id',
        'farmer_user_id',
        'quotation_id',
        'delivery_method',
        'delivery_address_snapshot',
        'subtotal',
        'delivery_fee',
        'total_amount',
        'currency',
        'status',
        'placed_at',
    ];

    protected $casts = [
        'delivery_address_snapshot' => 'array',
        'placed_at' => 'datetime',
    ];

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_user_id');
    }

    public function farmer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'farmer_user_id');
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusHistory(): HasMany
    {
        return $this->hasMany(OrderStatusHistory::class);
    }
}
