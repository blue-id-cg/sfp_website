<?php

namespace App\Http\Controllers;

use App\Models\ContentBlock;
use App\Models\Page;
use App\Models\Trade;
use Illuminate\View\View;

class MetierController extends Controller
{
    public function index(): View
    {
        return view('metiers.index', [
            'page' => Page::query()->where('slug', 'metiers')->firstOrNew(),
            'trades' => Trade::query()->orderBy('position')->get(),
            'instruments' => ContentBlock::query()->group('instruments')->orderBy('position')->get(),
        ]);
    }

    public function show(Trade $trade): View
    {
        return view('metiers.show', [
            'trade' => $trade,
            'more' => Trade::query()->where('id', '!=', $trade->id)->orderBy('position')->take(3)->get(),
        ]);
    }
}
