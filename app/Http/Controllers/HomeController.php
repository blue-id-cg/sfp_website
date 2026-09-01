<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\ContentBlock;
use App\Models\GalleryImage;
use App\Models\Page;
use App\Models\Realisation;
use App\Models\SiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'page' => Page::query()->where('slug', 'home')->firstOrNew(),
            'settings' => SiteSetting::current(),
            'actualites' => Actualite::query()->published()->latest('published_at')->take(3)->get(),
            'galleryImages' => GalleryImage::query()->orderBy('position')->take(9)->get(),
            'engagements' => ContentBlock::query()->group('hse_metrics')->orderBy('position')->get(),
            'equipmentSpecs' => ContentBlock::query()->group('equipment_specs')->orderBy('position')->get(),
            'instruments' => ContentBlock::query()->group('instruments')->orderBy('position')->get(),
            'entValues' => ContentBlock::query()->group('home_ent_values')->orderBy('position')->get(),
            'realisations' => Realisation::query()->published()->orderBy('position')->get(),
        ]);
    }
}
