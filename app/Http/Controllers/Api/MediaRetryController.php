<?php

namespace App\Http\Controllers\Api;

use App\DTO\MediaDTO;
use App\Enums\MediaStatus;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Service\MediaHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MediaRetryController extends Controller
{
    public function __construct(
        protected MediaHelper $mediaHelper
    ) {}

    public function __invoke(Media $media): JsonResponse
    {
        if ($media->status !== MediaStatus::Failed) {
            return response()->json([
                "message" => "Apenas midias com falha podem ser reenviadas.",
            ], 422);
        }

        try {
            $media = $this->mediaHelper->retryMedia($media);
        } catch (\Exception $exception) {
            $traceId = (string) Str::uuid();
            Log::error("[{$traceId}] {$exception->getMessage()}", [
                "exception" => $exception,
            ]);
            return response()->json([
                "message" => "Ocorreu um erro ao reenviar a midia!",
                "trace_id" => $traceId,
            ], 500);
        }

        return response()->json([
            "message" => "Midia reenviada com sucesso!",
            "media" => MediaDTO::fromModel($media)->toArray(),
        ]);
    }
}
