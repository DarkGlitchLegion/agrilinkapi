<?php

namespace App\Models\Identity;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'language',
        'preferred_notification_channel',
        'marketing_opt_in',
    ];

    protected $casts = [
        'marketing_opt_in' => 'boolean',
    ];
}
