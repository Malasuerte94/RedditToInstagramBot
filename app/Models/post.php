<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
     protected $guarded = ['id']; 

    public function igAccount(): HasMany
    {
        return $this->hasMany(IgAccount::class);
    }
    public function redditScraper(): HasMany
    {
        return $this->hasMany(RedditScraper::class);
    }
    public function hashtags(): HasMany
    {
        return $this->hasMany(Hashtag::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
