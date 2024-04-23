<?php

namespace App\Services;

use App\Http\Requests\Applications\CreateApplicationRequest;
use App\Models\Application;

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
}
