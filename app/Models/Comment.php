<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Attributes:
 * @property int $id
 * @property string $body
 * @property int $blog_id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 *
 * Relationships:
 * @property \App\Models\Blog $blog
 * @property \App\Models\User $user
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'blog_id',
        'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
