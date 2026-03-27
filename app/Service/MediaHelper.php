<?php

namespace App\Service;

use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Auth;

class MediaHelper
{
    public function __construct(
        protected RabbitMQService $rabbitMQService,
    ){}

    public function publishMediaRabbitMQ(string $url, string $format = "mp4"): void
    {
        $platform = SocialNetwork::all()->first(function ($network) use ($url) {
           return str_contains($url, $network->base_url);
        });

        $media = Auth::user()->medias()->create([
            "social_network_id" => $platform?->id,
            "original_url" => $url,
            "format" => $format
        ]);

        $this->rabbitMQService->publish(json_encode([
            "media_id" => $media->id,
            "download_url" => $url,
            "format" => $format
        ]));
    }
}
