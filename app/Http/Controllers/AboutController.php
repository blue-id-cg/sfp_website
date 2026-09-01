<?php

namespace App\Http\Controllers;

use App\Models\ContentBlock;
use App\Models\Milestone;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        return view('about.index', [
            'page' => Page::query()->where('slug', 'about')->firstOrNew(),
            'settings' => SiteSetting::current(),
            'expertise' => ContentBlock::query()->group('about_expertise')->orderBy('position')->get(),
            'pillars' => ContentBlock::query()->group('about_pillars')->orderBy('position')->get(),
            'values' => ContentBlock::query()->group('about_values')->orderBy('position')->get(),
            'milestones' => Milestone::query()->orderBy('position')->get(),
        ]);
    }
}
