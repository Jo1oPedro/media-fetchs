<?php

namespace App\Service;

use App\Enums\MediaStatus;
use App\Models\Media;
use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Auth;

class MediaHelper
{
    public function __construct(
        protected RabbitMQService $rabbitMQService,
    ){}

    public function publishMediaRabbitMQ(string $url, string $format = "mp4"): Media
    {
        $platform = SocialNetwork::all()->first(function ($network) use ($url) {
           return str_contains($url, $network->base_url);
        });

        $media = Auth::user()->medias()->create([
            "social_network_id" => $platform?->id,
            "original_url" => $url,
            "format" => $format
        ]);

        $this->publishToQueue($media);

        return $media->load('socialNetwork');
    }

    public function retryMedia(Media $media): Media
    {
        $media->update([
            "status" => MediaStatus::Pending,
            "s3_url" => null,
        ]);

        $this->publishToQueue($media);

        return $media->load('socialNetwork');
    }

    private function publishToQueue(Media $media): void
    {
        $this->rabbitMQService->publish(json_encode([
            "media_id" => $media->id,
            "download_url" => $media->original_url,
            "format" => $media->format->value,
        ]));
    }
}
