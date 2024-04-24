<?php

namespace App\Services;

use App\Http\Requests\Housings\CreateHousingRequest;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageService
{

    public function storeFromHousingRequest(CreateHousingRequest $request, int $housingId)
    {
        $image = Storage::disk('public')->put( "/".$housingId. "/", $request->file('image'));
        //$image returns the house_id/encodedname.extension --> basically the way to actually access the file

        Image::create([
            'housing_id' => $housingId,
            'is_preview' => true,
            'filename' => $request->file('image')->getClientOriginalName(),
            'path' => $image,
        ]);
    }
}
