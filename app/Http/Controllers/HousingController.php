<?php

namespace App\Http\Controllers;

use App\Services\HousingService;
use Illuminate\Http\Request;

class HousingController extends Controller
{
    protected HousingService $housingService;

    public function __construct(HousingService $housingService)
    {
        $this->housingService = $housingService;
    }

    public function list(Request $request)
    {
        return view('housing.list', [
            'user' => $request->user(),
            'housings' => $this->housingService->list(),
        ]);
    }

    //TODO fix these placeholder methods, create requests, etc...
    public function show(Request $request, int $id)
    {
        return view('housing.show', [
            'user' => $request->user(),
            'housing' => $this->housingService->show($id),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $this->housingService->update($id, $request->all());

        return redirect()->route('housings.show', ['id' => $id]);
    }

    public function destroy(Request $request, int $id)
    {
        $this->housingService->destroy($id);

        return redirect()->route('housings.list');
    }

    public function store(Request $request)
    {
        $this->housingService->store($request->validate());

        return redirect()->route('housings.list');
    }
}
