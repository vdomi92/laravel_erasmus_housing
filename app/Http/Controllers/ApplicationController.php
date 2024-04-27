<?php

namespace App\Http\Controllers;

use App\Http\Requests\Applications\CreateApplicationRequest;
use App\Models\Application;
use App\Models\Housing;
use App\Services\ApplicationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function __construct(
        protected ApplicationService $applicationService
    ) {}

    /**
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {
        $id = (int)$request->route('id');

        return view('applications.create', ['id' => $id]);
    }

    /**
     * @param CreateApplicationRequest $request
     * @return RedirectResponse
     */
    public function store(CreateApplicationRequest $request): RedirectResponse
    {
        $response = Gate::inspect('create', [Application::class, $request['housing_id']]);

        if($response->denied()){
            return redirect(route('housings.show', $request['housing_id']))->with('error', $response->message());
        }

        $this->applicationService->create($request);

        return redirect(route('dashboard', absolute: false))->with('success', $response->message());
    }


    public function reviewList(Request $request)
    {
        $housingId = (int)$request->route('id');
        $housingWithApplications = $this->applicationService->getApplicationsByHousingId($housingId);

        dd($housingWithApplications);

        $ownerId = $housingWithApplications->user_id;

        $response = Gate::inspect('manage', [Housing::class, $ownerId]);

        if($response->denied()){
            return redirect(route('dashboard', absolute: false))->with('error', $response->message());
        }

        return view('applications.review', [
            'applications' => $housingWithApplications->applications,
        ]);
    }
}
