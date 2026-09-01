<?php

namespace App\Http\Controllers;

use App\Models\ContentBlock;
use App\Models\Page;
use Illuminate\View\View;

class EquipementController extends Controller
{
    public function index(): View
    {
        return view('equipements.index', [
            'page' => Page::query()->where('slug', 'equipements')->firstOrNew(),
            'perks' => ContentBlock::query()->group('equipements_perks')->orderBy('position')->get(),
        ]);
    }
}
