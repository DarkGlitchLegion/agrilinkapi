<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KnowledgeArticle extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'summary',
        'body',
        'language',
        'author_user_id',
        'reviewed_by',
        'source_url',
        'status',
        'published_at',
        'reviewed_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(KnowledgeCategory::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function commodities(): BelongsToMany
    {
        return $this->belongsToMany(Commodity::class, 'article_commodities', 'knowledge_article_id', 'commodity_id');
    }
}
