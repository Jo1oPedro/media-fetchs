<?php

namespace App\Http\Controllers\Discord;

use App\Http\Controllers\Controller;

class DiscordOauthController extends Controller
{
    public function __invoke()
    {
        $discordUrl = config("services.discord.url");
        return redirect()->away($discordUrl);
    }
}
