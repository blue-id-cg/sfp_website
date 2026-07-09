<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\Offre;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'actualitesCount' => Actualite::query()->count(),
            'offresCount' => Offre::query()->count(),
            'galleryCount' => GalleryImage::query()->count(),
            'unreadMessagesCount' => ContactMessage::query()->whereNull('read_at')->count(),
        ]);
    }
}
