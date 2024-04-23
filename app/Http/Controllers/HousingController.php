<?php

namespace App\Http\Controllers;

use App\Services\HousingService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HousingController extends Controller
{
    public function __construct(protected HousingService $housingService)
    {
    }

    /**
     * @return View
     */
    public function list(): View
    {
        return view('housing.list', [
            'housings' => $this->housingService->list(),
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function show(Request $request): View
    {
        $id = (int)$request->route('id');

        return view('housing.show', [
            'user' => $request->user(),
            'housing' => $this->housingService->getByIdWithRelations($id),
        ]);
    }

    //TODO fix these placeholder methods, create requests, etc...
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
