<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationDelivery extends Model
{
    protected $fillable = [
        'notification_reference',
        'user_id',
        'channel',
        'provider_reference',
        'status',
        'attempt_count',
        'sent_at',
        'error_message',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
