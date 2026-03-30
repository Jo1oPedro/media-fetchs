<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyDownloadController extends Controller
{
    public function __invoke()
    {
        $downloads = Auth::user()
            ->medias()
            ->with("socialNetwork")
            ->latest()
            ->paginate(10);

        return view("dashboard/my-downloads/index", compact("downloads"));
    }
}
