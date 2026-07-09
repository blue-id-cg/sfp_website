<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HseController extends Controller
{
    public function index(): View
    {
        return view('hse.index');
    }
}
