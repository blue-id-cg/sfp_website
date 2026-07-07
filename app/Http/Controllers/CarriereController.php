<?php

namespace App\Http\Controllers;

use App\Support\Content\Offres;
use Illuminate\View\View;

class CarriereController extends Controller
{
    public function index(): View
    {
        return view('carrieres.index', [
            'offres' => Offres::all(),
        ]);
    }
}
