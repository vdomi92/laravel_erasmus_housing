<?php

namespace App\Http\Controllers;

use App\Http\Requests\Housings\CreateHousingRequest;
use App\Http\Requests\Housings\UpdateHousingRequest;
use App\Models\Housing;
use App\Services\HousingService;
use App\Services\ImageService;
use Illuminate\Support\Facades\Gate;
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
    public function edit(Request $request): View
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
    public function store(CreateHousingRequest $request): RedirectResponse
    {
        $housing = $this->housingService->store($request);

        if($request->hasFile('image')){
            $this->imageService->storeFromHousingRequest($request, $housing->id);
        }

        return redirect()->route('housings.show', ['id' => $housing->id]);
    }

    /**
     * @param UpdateHousingRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateHousingRequest $request): RedirectResponse
    {
        $id = (int)$request->route('id');

        $housing = $this->housingService->getEntity($id);
        $response = Gate::inspect('update', [Housing::class, $housing]);

        if($response->denied()){
            return redirect(route('housings.show', $id))->with('error', $response->message());
        }

        $updated = $this->housingService->update($request, $housing);
        if(!$updated){
            return redirect(route('housings.show', $id))->with('error', 'Failed to update housing');
        }

        return redirect()->route('housings.show', ['id' => $id])->with('success', $response->message());
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        $id = (int)$request->route('id');
        $housing = $this->housingService->getEntity($id);

        $response = Gate::inspect('update', [Housing::class, $housing]);

        if($response->denied()){
            return redirect(route('housings.show', $id))->with('error', $response->message());
        }

        $deleted = $housing->delete();
        if(!$deleted){
            return redirect(route('housings.show', $id))->with('error', 'Failed to delete housing');
        }

        return redirect()->route('dashboard')->with('success', $response->message());
    }


    /**
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function manage(Request $request): RedirectResponse|View
    {
        $ownerId = $request->route('id');

        $response = Gate::inspect('manage', [Housing::class, $ownerId]);
        if($response->denied()){
            return redirect(route('dashboard'))->with('error', $response->message());
        }

        return view('housing.manage', [
            'housings' => $this->housingService->getByOwner($ownerId),
        ]);
    }
}
