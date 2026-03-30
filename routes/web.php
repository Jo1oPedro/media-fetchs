<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DownloadController;
use App\Http\Controllers\Dashboard\MyDownloadController;
use App\Http\Controllers\Discord\DiscordOauthController;
use App\Http\Controllers\Discord\ProcessOauthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("home/index");
});

Route::middleware("guest")->group(function () {
    Route::get("/register", [AuthController::class, "showRegister"])->name("register.form");
    Route::post("/register", [AuthController::class, "register"])->name("register");

    Route::get("/login", [AuthController::class, "showLogin"])->name("login.form");
    Route::post("/login", [AuthController::class, "login"])->name("login");

    Route::get("/discord-oauth", DiscordOauthController::class)->name("discord.oauth");
    Route::get("/process-oauth", ProcessOauthController::class)->name("discord.process-oauth");
});

Route::middleware("auth")->group(function () {
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
    Route::get("/download", DownloadController::class)->name("download");
    Route::get("/my-downloads", MyDownloadController::class)->name("my-downloads");
});
