<?php

namespace App\Http\Controllers\Api;

use App\Events\MediaStatusUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MediaController\UpdateMediaStatusFormRequest;
use App\Models\Media;

class MediaCallbackController extends Controller
{
    public function __invoke(UpdateMediaStatusFormRequest $request, Media $media)
    {
        $media = Media::findOrFail($request->input("media_id"));

        $media->update([
            "s3_url" => $request->input("url"),
            "status" => $request->input("status")
        ]);

        event(new MediaStatusUpdated($media));

        return response()->json(["dale"]);
    }
}
