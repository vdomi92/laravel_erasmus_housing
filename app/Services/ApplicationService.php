<?php

namespace App\Services;

use App\Http\Requests\Applications\CreateApplicationRequest;
use App\Models\Application;
use App\Models\Housing;
use Illuminate\Database\Eloquent\Model;

class ApplicationService
{
    /**
     * @param CreateApplicationRequest $request
     * @return void
     */
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
     * @return Model
     */
    public function getApplicationsWithHousing(int $housingId): Model
    {
        return Housing::with([
            'applications' => ['applicant'],
        ])
            ->findOrFail($housingId);
    }
}
