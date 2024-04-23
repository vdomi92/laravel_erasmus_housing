<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * @mixin Builder
 */
class Image extends Model
{
    public $preventsLazyLoading = true;

    protected $fillable = [
        'is_preview',
        'filename',
        'path',
    ];

    /**
     * @return BelongsTo
     */
    public function housing(): BelongsTo
    {
        return $this->belongsTo(Housing::class);
    }

    /**
     * @return HasOneThrough
     */
    public function uploader(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Housing::class);
    }
}
