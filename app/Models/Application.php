<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Application extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'message',
        'start_date',
        'duration',
        'is_accepted',
        'user_id',
        'housing_id'
    ];

    /**
     * Gets the user that applied for the housing.
     *
     * @return BelongsTo
     */
    public function applicant(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets the housing that the user applied for.
     *
     * @return BelongsTo
     */
    public function housing(): BelongsTo
    {
        return $this->belongsTo(Housing::class);
    }

    /**
     * Gets the owner of the housing that the user applied for.
     *
     * @return HasOneThrough
     */
    public function houseOwner(): HasOneThrough
    {
        return $this->throughHousing()->hasOwner();
    }
}
