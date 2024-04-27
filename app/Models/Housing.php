<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin Builder
 * @property int $id
 * @property int $user_id
 * @property Application[] $applications
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
        'nr_of_slots',
        'user_id',
    ];

    /**
     * Get the user that owns the housing.
     *
     * @return HasOne
     */
    public function owner(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
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

    /**
     * Get the images for the housing.
     *
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'housing_id', 'id');
    }

    /**
     * Get the placeholder preview image for the housing if no preview was uploaded.
     *
     * @return string
     */
    public function getPlaceholderImage(): string
    {
        return asset('storage/house-placeholder.png');
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeWithPreviewImage(Builder $query): void
    {
      $query->addSelect([
          'preview_image' => Image::select('path')
                ->whereColumn('housing_id', 'housings.id')
                ->where('is_preview', '=', 1)
                ->limit(1),
        ]);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeWithAcceptedApplicationsCount(Builder $query): void
    {
        $query->addSelect([
            'accepted_count' => Application::selectRaw('count(*)')
                ->whereColumn('housing_id', '=', 'housings.id')
                ->where('is_accepted', '=', 1),
        ]);
    }
}
