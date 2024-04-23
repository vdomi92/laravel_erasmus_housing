<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $preventsLazyLoading = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the housings for the user.
     *
     * @return HasMany
     */
    public function housings(): HasMany
    {
        return $this->hasMany(Housing::class);
    }

    /**
     * Get the applications made by the user.
     *
     * @return HasMany
     */
    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Gets the users that applied for this user's housing.
     *
     * @return HasManyThrough
     */
    public function applicants(): HasManyThrough
    {
        return $this->throughHousings()->hasApplicants();
    }
}
