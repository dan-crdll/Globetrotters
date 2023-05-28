<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Follow extends Model
{
    public function followed(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'FOLLOWED', 'ID');
    }
}
