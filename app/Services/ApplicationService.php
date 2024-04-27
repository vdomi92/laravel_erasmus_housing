<?php

namespace App\Services;

use App\Http\Requests\Applications\CreateApplicationRequest;
use App\Models\Application;
use App\Models\Housing;
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
     * @return Model
     */
    public function getApplicationsByHousingId(int $housingId): Model
    {
        $query = Housing::with([
                'applications' => ['applicant'],
            ])
            ->where('id','=', $housingId);

//        dd($query->toRawSql());
        $start = microtime(true);
        $query->get();
        $time = microtime(true) - $start;
        dd($time);


        return Housing::find($housingId)
            ->with([
                'applications' => ['applicant']
            ])
            ->first();
    }
}
