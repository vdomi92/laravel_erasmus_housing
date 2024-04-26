<?php

namespace App\Services;

use App\Http\Requests\Housings\CreateHousingRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageService
{

    /**
     * @param CreateHousingRequest $request
     * @param int $housingId
     * @return Image
     */
    public function storeFromHousingRequest(CreateHousingRequest $request, int $housingId): Image
    {
        $image = Storage::disk('public')->put( "/".$housingId. "/", $request->file('image'));

        return Image::create([
            'housing_id' => $housingId,
            'is_preview' => true,
            'filename' => $request->file('image')->getClientOriginalName(),
            'path' => $image,
        ]);
    }
}
