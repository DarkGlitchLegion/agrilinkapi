<?php

namespace App\Models\Identity;

use Illuminate\Database\Eloquent\Model;

class VerificationDocument extends Model
{
    protected $fillable = [
        'user_id',
        'document_type',
        'file_path',
        'status',
        'reviewed_by',
    ];
}
