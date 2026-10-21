<?php

namespace App\Models\Buyers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessMember extends Model
{
    protected $fillable = [
        'business_profile_id',
        'user_id',
        'business_role',
        'status',
    ];

    public function businessProfile(): BelongsTo
    {
        return $this->belongsTo(BusinessProfile::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
