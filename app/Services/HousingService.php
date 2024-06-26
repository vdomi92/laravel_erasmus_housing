<?php

namespace App\Services;

use App\Http\Requests\Housings\CreateHousingRequest;
use App\Http\Requests\Housings\UpdateHousingRequest;
use App\Models\Housing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HousingService
{

    /**
     * Returns the list of housings with the preview image and the count of accepted applications.
     *
     * @return Collection
     */
    public function list(): Collection
    {
        //This could be refactored to use the scopes/eloquent instead of DB facade, but I'll leave it as it is.
        //Purpose is to practice.
        $query = DB::table('housings')->select('housings.*');

        //Join the applications and count the accepted ones to be able to calculate the available slots
        $query->leftJoinSub(
            DB::table('applications')
                ->where('applications.is_accepted', 1)
                ->select('applications.housing_id')
                ->selectRaw('COUNT(applications.id) as accepted_count')
                ->groupBy('applications.housing_id'),
            'accepted_applications',
            'accepted_applications.housing_id',
            '=',
            'housings.id'
        );

        $query->addSelect('accepted_count');

        //Join the preview image to the housing, should apply logic to only have one preview whenever saving one,
        // but applying limit just to be safe
        $query->leftJoinSub(
            DB::table('images')
                ->where('is_preview', 1)
                ->limit(1)
                ->select('images.*'),
            'preview_images',
            'preview_images.housing_id',
            '=',
            'housings.id'
        );

        $query->addSelect('preview_images.filename as filename', 'preview_images.path as path');

        //Filter the housings that have available slots, adding null constraint
        //is important because > 0 will not return true for NULL values
        $query->whereRaw('housings.nr_of_slots - accepted_count > 0 OR accepted_count IS NULL');

        return $query->get();
    }

    /**
     *  Finds requested entity by ID or throw ModelNotFoundException<Housing> if not found.
     *  Relations loaded: preview image, accepted applications count, owner information.
     *
     * @param int $id
     * @return Housing
     */
    public function getWithDetails(int $id): Housing
    {
        return Housing::with('owner')
            ->withPreviewImage()
            ->withAcceptedApplicationsCount()
            ->where('housings.id', '=', $id)
            ->get(['housings.*', 'preview_image', 'accepted_count'])->first()

            ?? throw new ModelNotFoundException(Housing::class);
    }

    /**
     * Creates a new housing entity.
     *
     * @param CreateHousingRequest $request
     * @return Housing
     */
    public function store(CreateHousingRequest $request): Housing
    {
        return Housing::create([
            'country' => $request['country'],
            'zip' => $request['zip'],
            'city' => ucwords(strtolower($request['city'])),
            'nr_of_slots' => $request['nr_of_slots'],
            'street' => ucwords(strtolower($request['street'])),
            'house_nr' => $request['house_nr'],
            'description' => $request['description'],
            'user_id' => $request->user()->id,
        ]);
    }

    /**
     * Edits housing entity's properties based on the request.
     *
     * @param UpdateHousingRequest $request
     * @param Housing $housing
     * @return bool
     */
    public function update(UpdateHousingRequest $request, Housing $housing): bool
    {
        return $housing->update([
            'country' => $request['country'],
            'zip' => $request['zip'],
            'city' => ucwords(strtolower($request['city'])),
            'nr_of_slots' => $request['nr_of_slots'],
            'street' => ucwords(strtolower($request['street'])),
            'house_nr' => $request['house_nr'],
            'description' => $request['description'],
        ]);
    }

    /**
     * @param int $id
     * @return Housing
     */
    public function getEntity(int $id): Housing
    {
        return Housing::findOrFail($id);
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getByOwner(int $userId): Collection
    {
        return Housing::where('user_id', $userId)->get();
    }
}
