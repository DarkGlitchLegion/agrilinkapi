<?php

namespace App\Models\Knowledge;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssistanceProgram extends Model
{
    protected $fillable = [
        'title',
        'description',
        'provider_name',
        'eligibility',
        'application_instructions',
        'official_url',
        'opens_at',
        'deadline_at',
        'status',
        'published_by',
    ];

    protected $casts = [
        'opens_at' => 'datetime',
        'deadline_at' => 'datetime',
    ];

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(AssistanceProgramAttachment::class);
    }
}
