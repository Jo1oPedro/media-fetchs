<?php

use App\Http\Controllers\Api\MediaCallbackController;
use App\Http\Controllers\Api\MediaCallbackDownloadFromDiscord;
use App\Http\Controllers\Api\MediaDownloadController;
use App\Http\Controllers\Api\MediaRetryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware("auth:sanctum")->group(function () {
    Route::post("/media", MediaDownloadController::class);
    Route::post("/media/{media}/retry", MediaRetryController::class);
});

Route::middleware("verify.token")->group(function () {
   Route::patch("/media/{media}", MediaCallbackController::class);
   Route::post("/discord/media", MediaCallbackDownloadFromDiscord::class);
});
