<?php

namespace App\Http\Controllers;

use App\Http\Requests\Applications\CreateApplicationRequest;
use App\Models\Application;
use App\Services\ApplicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function __construct(
        protected ApplicationService $applicationService
    ) {}

    public function create(Request $request): View
    {
        $id = (int)$request->route('id');

        return view('applications.create', ['id' => $id]);
    }

    public function store(CreateApplicationRequest $request)
    {
        $response = Gate::inspect('create', [Application::class, $request['housing_id']]);

        if($response->denied()){
            return redirect(route('housings.show', $request['housing_id']))->with('error', $response->message());
        }

        $this->applicationService->create($request);

        return redirect(route('dashboard', absolute: false))->with('success', $response->message());
    }
}
