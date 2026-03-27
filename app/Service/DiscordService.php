<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DiscordService
{
    public function processOauth(Request $request)
    {
        $code = $request->get("code");

        if(!$code) {
            return redirect()->route("login.form")->withErrors([
                "oauth" => "Authorization code not provided"
            ]);
        }

        $response = Http::asForm()->post("https://discordapp.com/api/oauth2/token", [
            "code" => $code,
            "client_id" => config("services.discord.client_id"),
            "client_secret" => config("services.discord.client_secret"),
            "grant_type" => "authorization_code",
            "redirect_uri" => config("services.discord.redirect_url"),
            "scope" => "identify%20connections%20email%20guilds%20openid"
        ]);

        if($response->failed()) {
            return redirect()->route("login.form")->withErrors([
                "oauth" => "Failed to authenticate with Discord"
            ]);
        }

        $data = $response->json();
        $accessToken = $data["access_token"];

        $userResponse = Http::withToken($accessToken)->get("https://discord.com/api/users/@me");

        if($userResponse->failed()) {
            return redirect()->route("login.form")->withErrors([
                "oauth" => "Failed to fetch user information from Discord",
            ]);
        }

        $discordUser = $userResponse->json();

        $user = User::updateOrCreate(
            ["discord_id" => $discordUser["id"]],
            [
                "name" => $discordUser["username"],
                "email" => $discordUser["email"] ?? $discordUser["id"] . "@discord.local",
                "password" => bcrypt(str()->random(32)),
                "discord_refresh_token" => $data["refresh_token"]
            ]
        );

        Auth::login($user);
    }
}
