<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\View\View;

class ActualiteController extends Controller
{
    public function index(): View
    {
        return view('actualites.index', [
            'actualites' => Actualite::query()->published()->latest('published_at')->paginate(9),
        ]);
    }

    public function show(Actualite $actualite): View
    {
        abort_unless($actualite->published_at?->lessThanOrEqualTo(now()), 404);

        return view('actualites.show', [
            'article' => $actualite,
            'more' => Actualite::query()
                ->published()
                ->whereKeyNot($actualite->id)
                ->latest('published_at')
                ->take(3)
                ->get(),
        ]);
    }
}
