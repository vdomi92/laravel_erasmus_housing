<?php

namespace App\Services;

use App\Models\Housing;
use Illuminate\Database\Eloquent\Collection;

class HousingService
{

    /**
     * Lists all housings with available places to apply for. Groups by country first and then by city.
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return Housing::withCount(['applications as accepted_count' => function ($query) {
            $query->where('is_accepted', 1);
        }])->where('accepted_count', '>', 0)
            ->groupBy('country', 'city')
            ->get();
    }
}
