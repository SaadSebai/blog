<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Attributes:
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 *
 * Relationships:
 * @property \App\Models\User $user
 * @property \Illuminate\Database\Eloquent\Collection $blogs
 *
 */
class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
