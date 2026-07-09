<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\GalleryImage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'actualites' => Actualite::query()->published()->latest('published_at')->take(3)->get(),
            'galleryImages' => GalleryImage::query()->orderBy('position')->take(9)->get(),
        ]);
    }
}
