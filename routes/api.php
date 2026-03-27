<?php

use App\Http\Controllers\Api\MediaCallbackController;
use App\Http\Controllers\Api\MediaDownloadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware("auth:sanctum")->group(function () {
    Route::post("/media", [MediaDownloadController::class, "download"]);
});

Route::middleware("verify.token")->group(function () {
   Route::patch("/media/{media}", [MediaCallbackController::class, "updateMediaStatus"]);
});

Route::get("/dale", function () {
   return response()->json(["response" => "dale123"]);
});
