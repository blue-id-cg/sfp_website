<?php

namespace App\Http\Controllers;

use App\Support\Content\Actualites;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'actualites' => Actualites::teaser(3),
        ]);
    }
}
