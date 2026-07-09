<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\View\View;

class CarriereController extends Controller
{
    public function index(): View
    {
        return view('carrieres.index', [
            'offres' => Offre::query()->published()->latest('published_at')->get(),
        ]);
    }
}
