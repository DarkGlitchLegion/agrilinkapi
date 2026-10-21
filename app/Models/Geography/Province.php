<?php

namespace App\Models\Geography;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];

    public function municipalities(): HasMany
    {
        return $this->hasMany(Municipality::class);
    }
}
