<?php

namespace App\Models\Geography;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmMember extends Model
{
    protected $fillable = [
        'farm_id',
        'user_id',
        'membership_role',
        'status',
        'invited_by',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inviter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_by');
    }
}
