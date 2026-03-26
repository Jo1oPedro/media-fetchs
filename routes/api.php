<?php

use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\MediaDownloadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware("auth:sanctum")->group(function () {
    Route::post("/download/media", [MediaDownloadController::class, "download"]);
});

Route::middleware("verify.token")->group(function () {
   Route::patch("/media/{media}/status", [MediaController::class, "updateMediaStatus"]);
});

Route::get("/dale", function () {
   return response()->json(["response" => "dale123"]);
});
