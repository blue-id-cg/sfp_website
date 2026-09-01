<?php

namespace App\Http\Controllers;

use App\Models\ContentBlock;
use App\Models\Page;
use Illuminate\View\View;

class HseController extends Controller
{
    public function index(): View
    {
        return view('hse.index', [
            'page' => Page::query()->where('slug', 'hse')->firstOrNew(),
            'engagements' => ContentBlock::query()->group('hse_metrics')->orderBy('position')->get(),
            'methodItems' => ContentBlock::query()->group('hse_method')->orderBy('position')->get(),
        ]);
    }
}
