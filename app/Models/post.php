<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
     protected $guarded = ['id']; 

    public function igAccount(): BelongsTo
    {
        return $this->belongsTo(IgAccount::class);
    }
    public function redditScraper(): BelongsTo
    {
        return $this->belongsTo(RedditScraper::class);
    }
}
