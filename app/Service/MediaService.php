<?php

namespace App\Service;

use App\DTO\CreateMediaDTO;
use App\Enums\MediaStatus;
use App\Models\Media;
use App\Models\SocialNetwork;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class MediaService
{
    public function __construct(
        protected RabbitMQService $rabbitMQService,
    ){}

    public function createMedia(User $user, CreateMediaDTO $dto): Media
    {
        $platform = SocialNetwork::all()->first(function ($network) use ($dto) {
            return str_contains($dto->originalUrl, $network->base_url);
        });

        return $user->medias()->create([
            "social_network_id" => $platform?->id,
            "original_url" => $dto->originalUrl,
            "format" => $dto->format,
            "s3_url" => $dto->s3Url,
            "status" => $dto->status,
        ]);
    }

    public function publishToQueue(Media $media): void
    {
        $this->rabbitMQService->publish(json_encode([
            "media_id" => $media->id,
            "download_url" => $media->original_url,
            "format" => $media->format->value,
        ]));
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
}
