<?php

namespace App\Http\Controllers;

use App\Models\ContentBlock;
use App\Models\Page;
use Illuminate\View\View;

class MetierController extends Controller
{
    public function index(): View
    {
        return view('metiers.index', [
            'page' => Page::query()->where('slug', 'metiers')->firstOrNew(),
            'trades' => ContentBlock::query()->group('trades')->orderBy('position')->get(),
            'instruments' => ContentBlock::query()->group('instruments')->orderBy('position')->get(),
        ]);
    }
}
