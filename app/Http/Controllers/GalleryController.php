<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $images = GalleryImage::query()->orderBy('position', 'asc')->paginate(24);

        return view('galerie.index', [
            'images' => $images,
            'totalImages' => $images->total(),
        ]);
    }
}
