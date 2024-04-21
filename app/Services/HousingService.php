<?php

namespace App\Services;

use App\Models\Housing;
use Illuminate\Database\Eloquent\Collection;

class HousingService
{
    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return Housing::all();
    }
}
