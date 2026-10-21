<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserNotificationPreference extends Model
{
    protected $fillable = [
        'user_id',
        'email_enabled',
        'sms_enabled',
        'weather_alerts_enabled',
        'price_alerts_enabled',
        'program_alerts_enabled',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
