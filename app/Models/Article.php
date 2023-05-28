<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'ARTICLE', 'ID');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'AUTHOR', 'ID');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'ARTICLE', 'ID');
    }

    public function numLikes(): int
    {
        return $this->likes->count();
    }
}
