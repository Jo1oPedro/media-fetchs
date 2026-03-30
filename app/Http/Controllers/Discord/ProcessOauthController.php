<?php

namespace App\Http\Controllers\Discord;

use App\Http\Controllers\Controller;
use App\Service\DiscordService;
use Illuminate\Http\Request;

class ProcessOauthController extends Controller
{
    public function __construct(
        private DiscordService $discordService
    ) {}

    public function __invoke(Request $request)
    {
        $this->discordService->processOauth($request);
        return redirect()->route("download")->with("success", "Logged in with Discord!");
    }
}
