<?php

namespace App\Models\Commerce;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'order_id',
        'reviewer_user_id',
        'reviewed_user_id',
        'rating',
        'comment',
        'moderation_status',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_user_id');
    }

    public function reviewedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_user_id');
    }
}
