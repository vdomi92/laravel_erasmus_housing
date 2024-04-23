<?php

namespace App\Services;

use App\Models\Housing;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class HousingService
{

    /**
     * Lists all housings with available places to apply for. Groups by country first and then by city.
     *
     * @return Collection
     */
    public function list(): Collection
    {
        return Housing::withAcceptedApplicationsCount()
            ->where('accepted_count', '>', 0)
            ->groupBy('country', 'city')
            ->get();
    }

    /**
     * Finds requested entity by ID or throw ModelNotFoundException<Housing> if not found.
     *
     * @param int $id
     * @return Housing
     */
    public function getByIdWithRelations(int $id): Housing
    {
        return Housing::with('owner')
            ->withAcceptedApplicationsCount()
            ->find($id)

            ?? throw new ModelNotFoundException(Housing::class);
    }
}
