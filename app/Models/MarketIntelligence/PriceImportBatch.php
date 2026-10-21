<?php

namespace App\Models\MarketIntelligence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceImportBatch extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'source_id',
        'file_path',
        'imported_by',
        'started_at',
        'finished_at',
        'status',
        'records_processed',
        'error_summary',
    ];

    protected $casts = [
        'error_summary' => 'array',
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(DataSource::class);
    }

    public function importer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'imported_by');
    }
}
