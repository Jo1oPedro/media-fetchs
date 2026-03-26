<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MediaDownloadController\DownloadFormRequest;
use App\Models\SocialNetwork;
use App\Service\RabbitMQService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MediaDownloadController extends Controller
{
    public function __construct(
        protected RabbitMQService $rabbitMQService
    ) {}

    public function download(DownloadFormRequest $request): JsonResponse
    {
        $url = $request->input("url");

        $platform = SocialNetwork::all()->first(function ($network) use ($url) {
           return str_contains($url, $network->base_url);
        });

        $media = Auth::user()->medias()->create([
            "social_network_id" => $platform?->id,
            "original_url" => $url,
            "format" => "mp4"
        ]);

        $this->rabbitMQService->publish(json_encode([
            "media_id" => $media->id,
            "download_url" => $url,
            "format" => "mp4"
        ]));

        return response()->json(["message" => "Url salva com sucesso!"]);
    }
}
