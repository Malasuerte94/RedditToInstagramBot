<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RedditAutomation extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function redditScraper(): BelongsTo
    {
        return $this->belongsTo(RedditScraper::class);
    }
    public function igAccount(): BelongsTo
    {
        return $this->belongsTo(IgAccount::class);
    }
    public function hashtag(): BelongsTo
    {
        return $this->belongsTo(Hashtag::class);
    }
}
