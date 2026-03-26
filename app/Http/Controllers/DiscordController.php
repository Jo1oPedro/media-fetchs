<?php

namespace App\Http\Controllers;

use App\Service\DiscordService;
use Illuminate\Http\Request;

class DiscordController extends Controller
{
    public function __construct(
        private DiscordService $discordService
    ) {}

    public function discordOauth()
    {
        $discordUrl = config("services.discord.url");
        return redirect()->away($discordUrl);
    }

    public function processOauth(Request $request)
    {
        $this->discordService->processOauth($request);
        return redirect()->route("download")->with("success", "Logged in with Discord!");
    }
}
