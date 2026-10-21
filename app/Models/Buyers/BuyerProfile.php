<?php

namespace App\Models\Buyers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BuyerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'buyer_type',
        'display_name',
        'contact_person',
        'preferred_barangay_id',
        'verification_status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class, 'preferred_barangay_id');
    }

    public function businessProfile(): HasOne
    {
        return $this->hasOne(BusinessProfile::class);
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(BuyerProductRequirement::class);
    }
}
