<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @mixin Builder
 */
class Housing extends Model
{
    use HasFactory;

    public $preventsLazyLoading = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'country',
        'zip',
        'city',
        'street',
        'house_nr',
        'description',
        'user_id',
        'nrOfSlots',
    ];

    /**
     * Get the user that owns the housing.
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the applications for the housing.
     *
     * @return HasMany
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get the applicants for the housing.
     *
     * @return HasManyThrough
     */
    public function applicants(): HasManyThrough
    {
        return $this->thoughApplications()->hasApplicant();
    }
}
