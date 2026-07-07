<?php

namespace App\Http\Controllers;

use App\Support\Content\Actualites;
use Illuminate\View\View;

class ActualiteController extends Controller
{
    public function index(): View
    {
        return view('actualites.index', [
            'actualites' => Actualites::all(),
        ]);
    }

    public function show(string $actualite): View
    {
        $article = Actualites::findBySlug($actualite);

        abort_if($article === null, 404);

        return view('actualites.show', [
            'article' => $article,
            'more' => Actualites::others($actualite),
        ]);
    }
}
