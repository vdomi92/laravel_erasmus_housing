<?php

namespace App\Services;

use App\Http\Requests\Applications\CreateApplicationRequest;
use App\Models\Application;
use App\Models\Housing;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ApplicationService
{
    public function create(CreateApplicationRequest $request): void
    {
        Application::create([
            'housing_id' => $request['housing_id'],
            'user_id' => auth()->id(),
            'duration' => $request['duration'],
            'message' => $request['message'],
        ]);

        //TODO event(new ApplicationCreated($application)); if logging added
    }

    /**
     * @param int $housingId
     * @return Collection
     */
    public function getApplicationsWithHousing(int $housingId): Collection
    {
        $query = Housing::with([
                'applications',
            ])
            ->where('id','=', $housingId);

        return $query->get();
    }
}
