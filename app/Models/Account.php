<?php

namespace App\Models;

use App\Models\Follow;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    public function followers(): HasMany
    {
        return $this->hasMany(Follow::class, 'FOLLOWED', 'ID');
    }

    public function followings(): HasMany
    {
        return $this->hasMany(Follow::class, 'FOLLOWER', 'ID');
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'AUTHOR', 'ID');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'AUTHOR', 'ID');
    }
}
