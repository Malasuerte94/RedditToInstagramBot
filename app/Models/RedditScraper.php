<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RedditScraper extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function igAccount(): BelongsTo
    {
        return $this->belongsTo(IgAccount::class);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
