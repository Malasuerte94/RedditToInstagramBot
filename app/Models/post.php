<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
     protected $guarded = ['id']; 

    public function igAccount(): BelongsTo
    {
        return $this->belongsTo(IgAccount::class);
    }
    public function redditScraper(): BelongsTo
    {
        return $this->belongsTo(RedditScraper::class);
    }
    public function hashtags(): BelongsTo
    {
        return $this->belongsTo(Hashtag::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function instagramAutomations(): BelongsTo
    {
        return $this->belongsTo(InstagramAutomation::class);
    }

    public function scopeConfirmed($query)
    {
        $query->where('confirmed', 1);
    }
    public function scopeNotPosted($query)
    {
        $query->where('posted', 0);
    }
}
