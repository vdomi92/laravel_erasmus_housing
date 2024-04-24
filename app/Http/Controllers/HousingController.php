<?php

namespace App\Http\Controllers;

use App\Http\Requests\Housings\CreateHousingRequest;
use App\Services\HousingService;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'housing' => $this->housingService->getByIdWithRelations($id),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('housing.create');
    }


    public function store(CreateHousingRequest $request)
    {
        $housing = $this->housingService->store($request);
        if($request->hasFile('image')){
            $this->imageService->storeFromHousingRequest($request, $housing->id);
        }

        return redirect()->route('housings.show', ['id' => $housing->id]);
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


}
