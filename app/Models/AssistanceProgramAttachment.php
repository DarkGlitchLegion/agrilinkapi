<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssistanceProgramAttachment extends Model
{
    protected $fillable = [
        'assistance_program_id',
        'storage_path',
        'label',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(AssistanceProgram::class);
    }
}
