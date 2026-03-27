<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MediaController\UpdateMediaStatusFormRequest;
use App\Models\Media;
use Illuminate\Support\Facades\Log;

class MediaCallbackController extends Controller
{
    public function updateMediaStatus(UpdateMediaStatusFormRequest $request, Media $media)
    {
        Media::whereId($request->input("media_id"))->update([
            "s3_url" => $request->input("url"),
            "status" => $request->input("status")
        ]);

        return response()->json(["dale"]);
    }
}
