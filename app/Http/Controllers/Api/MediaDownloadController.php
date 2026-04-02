<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateMediaDTO;
use App\DTO\MediaDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MediaDownloadController\DownloadFormRequest;
use App\Service\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MediaDownloadController extends Controller
{
    public function __construct(
        protected MediaService $mediaService
    ) {}

    public function __invoke(DownloadFormRequest $request): JsonResponse
    {
        try {
            $dto = new CreateMediaDTO(
                originalUrl: $request->input("url"),
                format: $request->input("format"),
            );

            $media = $this->mediaService->createMedia(Auth::user(), $dto);
            $this->mediaService->publishToQueue($media);
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
            "media" => MediaDTO::fromModel($media->load('socialNetwork'))->toArray(),
        ]);
    }
}
