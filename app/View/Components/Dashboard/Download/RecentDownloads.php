<?php

namespace App\View\Components\Dashboard\Download;

use App\Enums\MediaFormat;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class RecentDownloads extends Component
{
    public array $icons = [
        "twitter" => "bi-twitter",
        "x" => "bi-x",
        "facebook" => "bi-facebook",
        "instagram" => "bi-instagram",
        "tiktok" => "fab-tiktok",
        "youtube" => "bi-youtube",
    ];

    public array $iconColor = [
        "twitter" => "text-blue-400",
        "x" => "text-gray-800",
        "facebook" => "text-blue-600",
        "instagram" => "text-pink-500",
        "tiktok" => "text-gray-800",
        "youtube" => "text-red-500",
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $recentMediaDownloads
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.download.recent-downloads');
    }

    public function getMediaType(MediaFormat $format): string
    {
        return match ($format) {
            MediaFormat::Mp4 => "Video",
            MediaFormat::Mp3 => "Audio",
        };
    }
}
