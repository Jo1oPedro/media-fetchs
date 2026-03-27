<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SocialNetwork;
use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    public function index()
    {
        $socialNetworksAvailable = SocialNetwork::all();
        $recentMediaDownloads = Auth::user()
            ->medias()
            ->with("socialNetwork")
            ->latest()
            ->take(4)
            ->get();

        return view("dashboard/download/index", compact(
            "socialNetworksAvailable",
            "recentMediaDownloads"
        ));
    }
}
