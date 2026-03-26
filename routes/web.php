<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DownloadController;
use App\Http\Controllers\DiscordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("home/index");
});

Route::middleware("guest")->group(function () {
    Route::get("/register", [AuthController::class, "showRegister"])->name("register.form");
    Route::post("/register", [AuthController::class, "register"])->name("register");

    Route::get("/login", [AuthController::class, "showLogin"])->name("login.form");
    Route::post("/login", [AuthController::class, "login"])->name("login");

    Route::get("/discord-oauth", [DiscordController::class, "discordOauth"])->name("discord.oauth");
    Route::get("/process-oauth", [DiscordController::class, "processOauth"])->name("discord.process-oauth");
});

Route::middleware("auth")->group(function () {
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");
    Route::get("/download", [DownloadController::class, "index"])->name("download");
});
