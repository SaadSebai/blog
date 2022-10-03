<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Attributes:
 * @property string $title
 * @property string $body
 * @property int $user_id
 *
 * Relationships:
 * @property User $user
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
}