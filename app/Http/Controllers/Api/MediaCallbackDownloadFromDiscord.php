<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateMediaDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Service\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MediaCallbackDownloadFromDiscord extends Controller
{
    public function __construct(
        protected MediaService $mediaService
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $user = User::whereDiscordId($request->discord_id)->firstOrFail();

        $dto = new CreateMediaDTO(
            originalUrl: $request->original_url,
            format: $request->media_format,
            s3Url: $request->s3_url,
        );

        $media = $this->mediaService->createMedia($user, $dto);

        return response()->json($media);
    }
}
