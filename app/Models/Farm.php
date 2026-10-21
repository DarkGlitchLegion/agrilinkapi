<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farm extends Model
{
    protected $fillable = [
        'owner_user_id',
        'name',
        'description',
        'barangay_id',
        'latitude',
        'longitude',
        'area_hectares',
        'verification_status',
        'is_public',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function barangay(): BelongsTo
    {
        return $this->belongsTo(Barangay::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(FarmMember::class);
    }

    public function crops(): HasMany
    {
        return $this->hasMany(FarmCrop::class);
    }

    public function listings(): HasMany
    {
        return $this->hasMany(ProductListing::class);
    }
}
