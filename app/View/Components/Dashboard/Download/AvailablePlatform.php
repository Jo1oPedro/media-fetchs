<?php

namespace App\View\Components\Dashboard\Download;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class AvailablePlatform extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Collection $availablePlatforms
    ) {}

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
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.download.available-platform');
    }
}
