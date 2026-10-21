<?php

namespace App\Models\Buyers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BusinessProfile extends Model
{
    protected $fillable = [
        'buyer_profile_id',
        'business_name',
        'business_type',
        'business_address',
        'business_email',
        'business_phone',
        'registration_reference',
        'verification_status',
    ];

    public function buyerProfile(): BelongsTo
    {
        return $this->belongsTo(BuyerProfile::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(BusinessMember::class);
    }
}
