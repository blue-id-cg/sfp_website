<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MetierController extends Controller
{
    public function index(): View
    {
        return view('metiers.index');
    }
}
