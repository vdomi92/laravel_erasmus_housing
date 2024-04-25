<?php

namespace App\Http\Controllers;

use App\Http\Requests\Housings\CreateHousingRequest;
use App\Http\Requests\Housings\UpdateHousingRequest;
use App\Models\Housing;
use App\Services\HousingService;
use App\Services\ImageService;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HousingController extends Controller
{
    public function __construct(
        protected HousingService $housingService,
        protected ImageService $imageService,
    ){}

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
            'housing' => $this->housingService->getWithDetails($id),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('housing.create-or-edit', [
            'housing' => new Housing(),
        ]);
    }

    /**
     * @param Request $request
     * @return View
     */
    public function edit(Request $request)
    {
        $id = (int)$request->route('id');

        return view('housing.create-or-edit', [
            'housing' => $this->housingService->getWithDetails($id),
        ]);
    }

    /**
     * @param CreateHousingRequest $request
     * @return RedirectResponse
     */
    public function store(CreateHousingRequest $request)
    {
        $housing = $this->housingService->store($request);
        if($request->hasFile('image')){
            $this->imageService->storeFromHousingRequest($request, $housing->id);
        }

        return redirect()->route('housings.show', ['id' => $housing->id]);
    }

    public function update(UpdateHousingRequest $request)
    {
        $id = (int)$request->route('id');
        $response = Gate::inspect('update', [Housing::class, $id]);

        if($response->denied()){
            return redirect(route('housings.show', $id))->with('error', $response->message());
        }

        $this->housingService->update($request);

        return redirect()->route('housings.show', ['id' => $id])->with('success', $response->message());
    }

    //TODO fix these placeholder methods, create requests, etc...
    public function destroy(Request $request, int $id)
    {
        $this->housingService->destroy($id);

        return redirect()->route('housings.list');
    }


}
