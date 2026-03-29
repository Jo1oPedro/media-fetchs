<?php

namespace App\Http\Controllers\Api;

use App\DTO\MediaDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MediaDownloadController\DownloadFormRequest;
use App\Service\MediaHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MediaDownloadController extends Controller
{
    public function __construct(
        protected MediaHelper $mediaHelper
    ) {}

    public function download(DownloadFormRequest $request): JsonResponse
    {
        try {
            $media = $this->mediaHelper->publishMediaRabbitMQ(
                url: $request->input("url")
            );
        } catch (\Exception $exception) {
            $traceId = (string) Str::uuid();
            Log::error("[{$traceId}] {$exception->getMessage()}", [
                "exception" => $exception
            ]);
            return response()->json([
                "message" => "Ocorreu um erro ao processar a url!",
                "trace_id" => $traceId
            ], 500);
        }

        return response()->json([
            "message" => "Url salva com sucesso!",
            "media" => MediaDTO::fromModel($media)->toArray(),
        ]);
    }
}
