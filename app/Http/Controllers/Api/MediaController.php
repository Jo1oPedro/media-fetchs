<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MediaController\UpdateMediaStatusFormRequest;
use App\Models\Media;
use Illuminate\Support\Facades\Log;

class MediaController extends Controller
{
    public function updateMediaStatus(UpdateMediaStatusFormRequest $request, Media $media)
    {
        Log::error(
            print_r(
                [
                    $request->input("url"),
                    $request->input("status")
                ],
                true
            )
        );

        Media::whereId($request->input("media_id"))->update([
            "s3_url" => $request->input("url"),
            "status" => $request->input("status")
        ]);

        return response()->json(["dale"]);
    }
}
