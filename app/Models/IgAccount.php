<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IgAccount extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function hashtag()
    {
        return $this->hasOne(Hashtag::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function redditScrapers(): HasMany
    {
        return $this->hasMany(RedditScraper::class);
    }
}
